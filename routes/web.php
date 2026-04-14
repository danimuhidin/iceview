<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\WarrantyController as AdminWarrantyController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dealer\WarrantyController as UserWarrantyController;
use App\Http\Controllers\Public\WarrantyCheckController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about-us', [PublicPageController::class, 'about'])->name('about');
Route::get('/products', [PublicPageController::class, 'products'])->name('products');
Route::get('/products/{slug}', [PublicPageController::class, 'productDetail'])->name('products.detail');
Route::get('/dealers', [PublicPageController::class, 'dealers'])->name('dealers');
Route::get('/waranty', [WarrantyCheckController::class, 'index'])->name('waranty');
Route::post('/warranty/check', [WarrantyCheckController::class, 'check'])->name('warranty.check.process');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/site-info', [SiteInfoController::class, 'edit'])->name('admin.site-info.edit');
    Route::put('/admin/site-info', [SiteInfoController::class, 'update'])->name('admin.site-info.update');
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.role.update');
    Route::put('/admin/users/{user}/password', [UserManagementController::class, 'resetPassword'])->name('admin.users.password.reset');
    Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('warranties/claims', [AdminWarrantyController::class, 'claimsIndex'])->name('claims.index');
    Route::resource('warranties', AdminWarrantyController::class)->only(['index', 'show', 'edit', 'update']);
    Route::post('warranties/claims/{item_id}/approve', [AdminWarrantyController::class, 'approveClaim'])->name('warranties.claims.approve');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->as('user.')->group(function () {
    Route::post('warranties/{item_id}/claim', [UserWarrantyController::class, 'claim'])->name('warranties.claim');
    Route::resource('warranties', UserWarrantyController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');