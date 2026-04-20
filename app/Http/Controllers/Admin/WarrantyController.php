<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WarrantyItemStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateWarrantyRequest;
use App\Models\Warranty;
use App\Models\WarrantyItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WarrantyController extends Controller
{
    private function warrantyQuery(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        return Warranty::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($subQuery) use ($search): void {
                    $subQuery->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('warranty_code', 'like', "%{$search}%")
                        ->orWhere('engine_number', 'like', "%{$search}%");
                });
            })
            ->with(['dealer', 'items'])
            ->withCount('items')
            ->latest();
    }

    public function index(Request $request): View
    {
        return view('admin.warranties.index', [
            'warranties' => $this->warrantyQuery($request)->paginate(10)->withQueryString(),
            'search' => trim((string) $request->query('search', '')),
        ]);
    }

    public function show(Warranty $warranty): View
    {
        return view('admin.warranties.show', [
            'warranty' => $warranty->load(['dealer', 'items']),
        ]);
    }

    public function edit(Warranty $warranty): View
    {
        return view('admin.warranties.edit', [
            'warranty' => $warranty->load(['dealer', 'items']),
        ]);
    }

    public function update(UpdateWarrantyRequest $request, Warranty $warranty): RedirectResponse
    {
        $warranty->fill($request->validated());
        $warranty->save();

        return redirect()->route('admin.warranties.show', $warranty)->with('status', 'Garansi berhasil diperbarui.');
    }

    public function claimsIndex(Request $request): View
    {
        return view('admin.claims.index', [
            'pendingClaims' => WarrantyItem::query()
                ->where('status', WarrantyItemStatus::PendingClaim->value)
                ->with(['warranty.dealer'])
                ->latest()
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    public function approveClaim(Request $request, int $item_id): RedirectResponse
    {
        $item = WarrantyItem::query()->with('warranty')->findOrFail($item_id);

        if ($item->status !== WarrantyItemStatus::PendingClaim->value) {
            return back()->with('status', 'Item ini belum berstatus pending claim.');
        }

        $item->status = WarrantyItemStatus::Claimed->value;
        $item->save();

        if (!empty(env('RESEND_API_KEY'))) {
            // To Dealer
            if ($item->warranty->dealer && $item->warranty->dealer->email) {
                Mail::to($item->warranty->dealer->email)->send(new \App\Mail\WarrantyClaimApprovedDealerMail($item));
            }

            // To Customer
            if ($item->warranty->customer_email) {
                Mail::to($item->warranty->customer_email)->send(new \App\Mail\WarrantyClaimApprovedCustomerMail($item));
            }
        }

        return back()->with('status', 'Klaim berhasil disetujui.');
    }
}