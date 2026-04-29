<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\WarrantyItemPosition;
use App\Enums\WarrantyItemStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\StoreWarrantyRequest;
use App\Http\Requests\Dealer\UpdateWarrantyRequest;
use App\Mail\WarrantyClaimedAdminMail;
use App\Mail\WarrantyCreatedAdminMail;
use App\Mail\WarrantyCreatedCustomerMail;
use App\Mail\WarrantyCreatedDealerMail;
use App\Models\Product;
use App\Models\User;
use App\Models\Warranty;
use App\Models\WarrantyItem;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
                        ->orWhere('engine_number', 'like', "%{$search}%")
                        ->orWhere('license_plate_number', 'like', "%{$search}%");
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
        abort_unless($warranty->dealer_id == $request->user()?->id, 403);

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
            'products' => Product::query()->active()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(StoreWarrantyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $warranty = DB::transaction(function () use ($request, $validated) {
            $warranty = Warranty::create([
                'dealer_id' => $request->user()->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'car_type' => $validated['car_type'],
                'engine_number' => $validated['engine_number'],
                'license_plate_number' => $validated['license_plate_number'] ?? null,
                'warranty_code' => $this->generateWarrantyCode(),
            ]);

            $activeProducts = Product::query()
                ->active()
                ->whereIn('id', array_values((array) ($validated['product_ids'] ?? [])))
                ->get()
                ->keyBy('id');

            foreach ($validated['item_positions'] as $position) {
                $selectedProductId = (int) ($validated['product_ids'][$position] ?? 0);
                $selectedProduct = $activeProducts->get($selectedProductId);

                if (! $selectedProduct) {
                    continue;
                }

                WarrantyItem::create([
                    'warranty_id' => $warranty->id,
                    'item_position' => $position,
                    'product_name' => $selectedProduct->name,
                    'status' => WarrantyItemStatus::Active->value,
                    'expired_at' => Carbon::now()->addYears(5),
                ]);
            }

            return $warranty;
        });

        if (! empty(env('RESEND_API_KEY'))) {
            // Send to Dealer
            Mail::to($request->user()->email)->send(new WarrantyCreatedDealerMail($warranty));
            sleep(1);

            // Send to Customer
            Mail::to($warranty->customer_email)->send(new WarrantyCreatedCustomerMail($warranty));
            sleep(1);

            // Send to Admins (Admin role except user ID 1)
            $admins = User::where('role', 'admin')->where('id', '!=', 1)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new WarrantyCreatedAdminMail($warranty));
                sleep(1);
            }
        }

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

        $warranty->fill($request->only(['customer_name', 'customer_email', 'license_plate_number']));
        $warranty->save();

        return redirect()->route('user.warranties.show', $warranty)->with('status', 'Data customer berhasil diperbarui.');
    }

    public function claim(Request $request, int $item_id): RedirectResponse
    {
        $item = WarrantyItem::query()->with('warranty')->findOrFail($item_id);

        abort_unless($item->warranty?->dealer_id == $request->user()->id, 403);

        if ($item->status !== WarrantyItemStatus::Active->value || $item->expired_at->isPast()) {
            return back()->with('status', 'Item tidak dapat diajukan klaim.');
        }

        $item->status = WarrantyItemStatus::PendingClaim->value;
        $item->save();

        if (! empty(env('RESEND_API_KEY'))) {
            $admins = User::where('role', 'admin')->where('id', '!=', 1)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new WarrantyClaimedAdminMail($item));
                sleep(1);
            }
        }

        return back()->with('status', 'Klaim item berhasil diajukan.');
    }
}
