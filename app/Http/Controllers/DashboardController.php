<?php

namespace App\Http\Controllers;

use App\Enums\WarrantyItemStatus;
use App\Models\User;
use App\Models\Warranty;
use App\Models\WarrantyItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function admin()
    {
        $totalAdmin = User::query()->where('role', 'admin')->count();
        $totalDealer = User::query()->where('role', 'user')->count();
        $totalCustomer = Warranty::query()
            ->select('customer_email')
            ->distinct()
            ->count('customer_email');
        $totalWarranty = Warranty::query()->count();
        $pendingClaim = WarrantyItem::query()->where('status', WarrantyItemStatus::PendingClaim->value)->count();
        $activeWarrantyItem = WarrantyItem::query()->where('status', WarrantyItemStatus::Active->value)->count();

        return view('admin.dashboard', [
            'stats' => [
                'total_admin' => $totalAdmin,
                'total_dealer' => $totalDealer,
                'total_customer' => $totalCustomer,
                'total_warranty' => $totalWarranty,
                'pending_claim' => $pendingClaim,
                'active_item' => $activeWarrantyItem,
            ],
        ]);
    }

    public function user()
    {
        $user = Auth::user();

        $warrantyQuery = Warranty::query()->where('dealer_id', $user->id);
        $warrantyIds = (clone $warrantyQuery)->pluck('id');

        $totalWarranty = (clone $warrantyQuery)->count();
        $totalCustomer = (clone $warrantyQuery)
            ->select('customer_email')
            ->distinct()
            ->count('customer_email');

        $pendingClaim = WarrantyItem::query()
            ->whereIn('warranty_id', $warrantyIds)
            ->where('status', WarrantyItemStatus::PendingClaim->value)
            ->count();

        $activeItem = WarrantyItem::query()
            ->whereIn('warranty_id', $warrantyIds)
            ->where('status', WarrantyItemStatus::Active->value)
            ->count();

        $claimedItem = WarrantyItem::query()
            ->whereIn('warranty_id', $warrantyIds)
            ->where('status', WarrantyItemStatus::Claimed->value)
            ->count();

        return view('user.dashboard', [
            'stats' => [
                'total_warranty' => $totalWarranty,
                'total_customer' => $totalCustomer,
                'pending_claim' => $pendingClaim,
                'active_item' => $activeItem,
                'claimed_item' => $claimedItem,
            ],
        ]);
    }
}
