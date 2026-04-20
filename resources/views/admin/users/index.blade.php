@extends('layouts.panel')

@section('title', 'Manajemen User | Ice View Indonesia')

@section('content')
    <section x-data="{
        createOpen: false,
        manageOpen: false,
        selected: { id: null, name: '', email: '', role: 'user', city: '', address: '', link_maps: '', phone: '', is_active: 1, protected: false },
        openManage(user) {
            this.selected = user;
            this.manageOpen = true;
        }
    }" class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">Manajemen User</h1>
                <p class="mt-1 text-sm text-slate-300">Kelola akun melalui modal: create, update profile, update role, reset
                    password, dan delete.</p>
            </div>
            <div class="flex items-center gap-2">
                <p class="rounded-md border border-slate-600/50 px-3 py-2 text-xs text-slate-300">Total:
                    {{ $users->total() }} akun</p>
                <button type="button" @click="createOpen = true"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Create
                    User</button>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}"
            class="mb-5 grid gap-3 rounded-xl border border-slate-700/60 bg-[#0f1a2f] p-4 md:grid-cols-[1fr_180px_auto]">
            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                placeholder="Cari nama atau email..."
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
            <select name="role"
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                <option value="all" @selected(($filters['role'] ?? 'all') === 'all')>Semua Role</option>
                <option value="admin" @selected(($filters['role'] ?? '') === 'admin')>Admin</option>
                <option value="user" @selected(($filters['role'] ?? '') === 'user')>User</option>
            </select>
            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Filter</button>
                <a href="{{ route('admin.users.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Reset</a>
            </div>
        </form>

        @if ($errors->createUser->any() || $errors->roleUpdate->any() || $errors->passwordReset->any())
            <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                <p class="font-semibold">Terdapat input yang belum valid.</p>
                @foreach ($errors->createUser->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                @foreach ($errors->roleUpdate->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                @foreach ($errors->passwordReset->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold">Email</th>
                        <th class="px-4 py-3 text-left font-semibold">Role</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($users as $user)
                        @php $isProtectedSuperAdmin = strtolower($user->email) === 'superadmin@mail.com'; @endphp
                        <tr class="cursor-pointer transition hover:bg-slate-800/40"
                            @click="openManage({ id: {{ $user->id }}, name: @js($user->name), email: @js($user->email), role: @js($user->role), city: @js($user->city), address: @js($user->address), link_maps: @js($user->link_maps), phone: @js($user->phone), is_active: {{ $user->is_active ? 1 : 0 }}, protected: {{ $isProtectedSuperAdmin ? 'true' : 'false' }} })">
                            <td class="px-4 py-4 font-semibold text-white">{{ $user->name }} @if ($isProtectedSuperAdmin)
                                    <span
                                        class="ml-2 inline-flex rounded-full bg-amber-400/20 px-2 py-0.5 text-[10px] font-semibold text-amber-200">PROTECTED</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">{{ $user->email }}</td>
                            <td class="px-4 py-4"><span
                                    class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-cyan-500/20 text-cyan-200' : 'bg-slate-600/40 text-slate-200' }}">{{ strtoupper($user->role) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-slate-400">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="mt-3 text-xs text-slate-400">Klik baris user untuk membuka modal kelola.</p>

        <div class="mt-5">{{ $users->links() }}</div>

        <div x-show="createOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/60"
            @click="createOpen = false"></div>
        <div x-show="createOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-2xl border border-slate-700 bg-[#0b1222] p-6 shadow-2xl shadow-black/50"
                @click.stop>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-white">Create User</h2>
                    <button type="button" class="text-slate-400 hover:text-white"
                        @click="createOpen = false">Close</button>
                </div>
                <form method="POST" action="{{ route('admin.users.store') }}" class="grid gap-4 md:grid-cols-2">
                    @csrf
                    <div><label class="mb-2 block text-sm text-slate-200">Nama</label><input type="text" name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            required></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Email</label><input type="email" name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            required></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Role</label><select name="role"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                            <option value="user" @selected(old('role', 'user') === 'user')>user</option>
                            <option value="admin" @selected(old('role') === 'admin')>admin</option>
                        </select></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Status</label><select name="is_active"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                            <option value="1" @selected(old('is_active', '1') == '1')>Aktif</option>
                            <option value="0" @selected(old('is_active') == '0')>Tidak Aktif</option>
                        </select></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Nama Kota</label><input type="text"
                            name="city" value="{{ old('city') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                    </div>
                    <div><label class="mb-2 block text-sm text-slate-200">No Telp</label><input type="text"
                            name="phone" value="{{ old('phone') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                    </div>
                    <div class="md:col-span-2"><label class="mb-2 block text-sm text-slate-200">Alamat</label>
                        <textarea name="address" rows="3"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">{{ old('address') }}</textarea>
                    </div>
                    <div class="md:col-span-2"><label class="mb-2 block text-sm text-slate-200">Link Maps</label><input
                            type="url" name="link_maps" value="{{ old('link_maps') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            placeholder="https://maps.google.com/...">
                        <p class="mt-2 text-xs text-slate-400">Masukkan URL lokasi tanpa preview.</p>
                    </div>
                    <div><label class="mb-2 block text-sm text-slate-200">Password</label><input type="password"
                            name="password"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            required></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Konfirmasi Password</label><input
                            type="password" name="password_confirmation"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            required></div>
                    <div class="md:col-span-2"><button type="submit"
                            class="w-full rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Simpan
                            User</button></div>
                </form>
            </div>
        </div>

        <div x-show="manageOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/60"
            @click="manageOpen = false"></div>
        <div x-show="manageOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-2xl border border-slate-700 bg-[#0b1222] p-6 shadow-2xl shadow-black/50"
                @click.stop>
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-white">Kelola User</h2>
                        <p class="text-xs text-slate-400" x-text="selected.name + ' - ' + selected.email"></p>
                        <p x-show="selected.protected" class="mt-1 text-xs text-amber-300">Akun superadmin utama
                            dilindungi dari delete dan downgrade role.</p>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-white"
                        @click="manageOpen = false">Close</button>
                </div>

                <div class="space-y-5">
                    <form method="POST" :action="`{{ url('/admin/users') }}/${selected.id}/role`"
                        class="grid gap-4 md:grid-cols-2">
                        @csrf
                        @method('PUT')
                        <div><label class="mb-2 block text-sm text-slate-200">Role</label><select name="role"
                                x-model="selected.role" :disabled="selected.protected"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF] disabled:cursor-not-allowed disabled:opacity-60">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select></div>
                        <div><label class="mb-2 block text-sm text-slate-200">Status</label><select name="is_active"
                                x-model="selected.is_active" :disabled="selected.protected"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF] disabled:cursor-not-allowed disabled:opacity-60">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select></div>
                        <div><label class="mb-2 block text-sm text-slate-200">Nama Kota</label><input type="text"
                                name="city" x-model="selected.city"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                        </div>
                        <div><label class="mb-2 block text-sm text-slate-200">No Telp</label><input type="text"
                                name="phone" x-model="selected.phone"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                        </div>
                        <div class="md:col-span-2"><label class="mb-2 block text-sm text-slate-200">Alamat</label>
                            <textarea name="address" x-model="selected.address" rows="3"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"></textarea>
                        </div>
                        <div class="md:col-span-2"><label class="mb-2 block text-sm text-slate-200">Link
                                Maps</label><input type="url" name="link_maps" x-model="selected.link_maps"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                                placeholder="https://maps.google.com/...">
                            <p class="mt-2 text-xs text-slate-400">Masukkan URL lokasi tanpa preview.</p>
                        </div>
                        <div class="md:col-span-2"><button type="submit" :disabled="selected.protected"
                                class="w-full rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110 disabled:cursor-not-allowed disabled:opacity-60">Update
                                User</button></div>
                    </form>

                    <form method="POST" :action="`{{ url('/admin/users') }}/${selected.id}/password`"
                        class="space-y-3 border-t border-slate-700 pt-4">
                        @csrf
                        @method('PUT')
                        <div><label class="mb-2 block text-sm text-slate-200">Password Baru</label><input type="password"
                                name="password"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                                required></div>
                        <div><label class="mb-2 block text-sm text-slate-200">Konfirmasi Password</label><input
                                type="password" name="password_confirmation"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                                required></div>
                        <button type="submit"
                            class="rounded-md border border-slate-500/50 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Reset
                            Password</button>
                    </form>

                    <form method="POST" :action="`{{ url('/admin/users') }}/${selected.id}`"
                        class="border-t border-slate-700 pt-4"
                        data-confirm-message="Yakin ingin menghapus user ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" :disabled="selected.protected"
                            class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500 disabled:cursor-not-allowed disabled:opacity-60">Delete
                            User</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
