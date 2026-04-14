<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\WarrantyItemPosition;
use App\Enums\WarrantyItemStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\StoreWarrantyRequest;
use App\Http\Requests\Dealer\UpdateWarrantyRequest;
use App\Models\Warranty;
use App\Models\WarrantyItem;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WarrantyController extends Controller
{
    private function warrantyQueryForDealer(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        return Warranty::query()
            ->where('dealer_id', $request->user()->id)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($subQuery) use ($search): void {
                    $subQuery->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('warranty_code', 'like', "%{$search}%")
                        ->orWhere('engine_number', 'like', "%{$search}%");
                });
            })
            ->withCount('items')
            ->latest();
    }

    private function generateWarrantyCode(): string
    {
        do {
            $code = 'KF-'.now()->format('Ymd').'-'.Str::upper(Str::random(4));
        } while (Warranty::where('warranty_code', $code)->exists());

        return $code;
    }

    private function loadWarrantyForDealer(Warranty $warranty, Request $request): Warranty
    {
        abort_unless($warranty->dealer_id === $request->user()?->id, 403);

        return $warranty->load(['dealer', 'items']);
    }

    public function index(Request $request): View
    {
        $warranties = $this->warrantyQueryForDealer($request)->paginate(10)->withQueryString();

        return view('dealer.warranties.index', [
            'warranties' => $warranties,
            'search' => trim((string) $request->query('search', '')),
        ]);
    }

    public function create(): View
    {
        return view('dealer.warranties.create', [
            'positions' => WarrantyItemPosition::values(),
        ]);
    }

    public function store(StoreWarrantyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($request, $validated): void {
            $warranty = Warranty::create([
                'dealer_id' => $request->user()->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'car_type' => $validated['car_type'],
                'engine_number' => $validated['engine_number'],
                'warranty_code' => $this->generateWarrantyCode(),
            ]);

            foreach ($validated['item_positions'] as $position) {
                $productName = trim((string) ($validated['product_names'][$position] ?? ''));

                if ($productName === '') {
                    continue;
                }

                WarrantyItem::create([
                    'warranty_id' => $warranty->id,
                    'item_position' => $position,
                    'product_name' => $productName,
                    'status' => WarrantyItemStatus::Active->value,
                    'expired_at' => Carbon::now()->addYears(5),
                ]);
            }
        });

        return redirect()->route('user.warranties.index')->with('status', 'Garansi berhasil dibuat.');
    }

    public function show(Warranty $warranty): View
    {
        return view('dealer.warranties.show', [
            'warranty' => $this->loadWarrantyForDealer($warranty, request()),
        ]);
    }

    public function edit(Warranty $warranty): View
    {
        return view('dealer.warranties.edit', [
            'warranty' => $this->loadWarrantyForDealer($warranty, request()),
        ]);
    }

    public function update(UpdateWarrantyRequest $request, Warranty $warranty): RedirectResponse
    {
        $warranty = $this->loadWarrantyForDealer($warranty, $request);

        $warranty->fill($request->only(['customer_name', 'customer_email']));
        $warranty->save();

        return redirect()->route('user.warranties.show', $warranty)->with('status', 'Data customer berhasil diperbarui.');
    }

    public function claim(Request $request, int $item_id): RedirectResponse
    {
        $item = WarrantyItem::query()->with('warranty')->findOrFail($item_id);

        abort_unless($item->warranty?->dealer_id === $request->user()->id, 403);

        if ($item->status !== WarrantyItemStatus::Active->value || $item->expired_at->isPast()) {
            return back()->with('status', 'Item tidak dapat diajukan klaim.');
        }

        $item->status = WarrantyItemStatus::PendingClaim->value;
        $item->save();

        return back()->with('status', 'Klaim item berhasil diajukan.');
    }
}
