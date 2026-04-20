<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    private const PROTECTED_SUPERADMIN_EMAIL = 'superadmin@mail.com';

    private function isProtectedSuperAdmin(User $user): bool
    {
        return strtolower($user->email) === self::PROTECTED_SUPERADMIN_EMAIL;
    }

    public function index()
    {
        $search = trim((string) request('search', ''));
        $role = (string) request('role', 'all');

        $users = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when(in_array($role, ['admin', 'user'], true), function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(10)
            ->appends([
                'search' => $search,
                'role' => $role,
            ]);

        return view('admin.users.index', [
            'users' => $users,
            'filters' => [
                'search' => $search,
                'role' => $role,
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('createUser', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'link_maps' => ['nullable', 'url', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'is_active' => ['required', 'boolean'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'city' => $validated['city'] ?? null,
            'address' => $validated['address'] ?? null,
            'link_maps' => $validated['link_maps'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'is_active' => (bool) $validated['is_active'],
            'password' => Hash::make($validated['password']),
        ]);

        if (!empty(env('RESEND_API_KEY'))) {
            Mail::to($user->email)->send(new \App\Mail\WelcomeUserMail($user, $validated['password']));
        }

        return back()->with('status', 'User baru berhasil dibuat.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validateWithBag('roleUpdate', [
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => ['required', 'boolean'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'link_maps' => ['nullable', 'url', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
        ]);

        if ($this->isProtectedSuperAdmin($user) && $validated['role'] !== 'admin') {
            return back()->with('status', 'Role superadmin utama tidak dapat diturunkan.');
        }

        if ($this->isProtectedSuperAdmin($user) && ! $validated['is_active']) {
            return back()->with('status', 'Superadmin utama harus tetap aktif.');
        }

        $actor = $request->user();

        if ($actor && $actor->id === $user->id && $validated['role'] !== 'admin') {
            return back()->with('status', 'Akun admin aktif tidak dapat menurunkan role dirinya sendiri.');
        }

        $user->role = $validated['role'];
        $user->is_active = (bool) $validated['is_active'];
        $user->city = $validated['city'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->link_maps = $validated['link_maps'] ?? null;
        $user->phone = $validated['phone'] ?? null;
        $user->save();

        return back()->with('status', 'Role user berhasil diperbarui.');
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validateWithBag('passwordReset', [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('status', 'Password user berhasil direset.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $actor = $request->user();

        if ($this->isProtectedSuperAdmin($user)) {
            return back()->with('status', 'Akun superadmin utama tidak dapat dihapus.');
        }

        if ($actor && $actor->id === $user->id) {
            return back()->with('status', 'Akun aktif tidak dapat dihapus.');
        }

        $user->delete();

        return back()->with('status', 'User berhasil dihapus.');
    }
}
