<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'link_maps' => ['nullable', 'url', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'is_active' => ['required', 'boolean'],
        ]);

        $user = $request->user();
        $user->name = $validated['name'];
        $user->city = $validated['city'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->link_maps = $validated['link_maps'] ?? null;
        $user->phone = $validated['phone'] ?? null;
        $user->is_active = (bool) $validated['is_active'];
        $user->save();

        return back()->with('status', 'Nama akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('status', 'Password berhasil diperbarui.');
    }
}
