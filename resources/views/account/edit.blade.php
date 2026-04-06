@extends('layouts.panel')

@section('title', 'Kelola Akun | Iceview')

@section('content')
    <section class="grid gap-6 lg:grid-cols-2">
        <article class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
            <h1 class="mb-1 text-2xl font-bold text-white">Kelola Akun</h1>
            <p class="mb-6 text-sm text-slate-300">Perbarui data profil, lokasi, dan status akun Anda.</p>

            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-200">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="city" class="mb-2 block text-sm font-semibold text-slate-200">Nama Kota</label>
                    <input id="city" type="text" name="city" value="{{ old('city', auth()->user()->city) }}"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30">
                    @error('city')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="mb-2 block text-sm font-semibold text-slate-200">Alamat</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30">{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="link_maps" class="mb-2 block text-sm font-semibold text-slate-200">Link Maps</label>
                    <input id="link_maps" type="url" name="link_maps"
                        value="{{ old('link_maps', auth()->user()->link_maps) }}"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        placeholder="https://maps.google.com/...">
                    <p class="mt-2 text-xs text-slate-400">Tempel tautan Google Maps cabang atau lokasi Anda.</p>
                    @error('link_maps')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="mb-2 block text-sm font-semibold text-slate-200">No Telp</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        placeholder="08xxxxxxxxxx">
                    @error('phone')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_active" class="mb-2 block text-sm font-semibold text-slate-200">Status Akun</label>
                    <select id="is_active" name="is_active"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30">
                        <option value="1" @selected(old('is_active', (int) auth()->user()->is_active) == 1)>Aktif</option>
                        <option value="0" @selected(old('is_active', (int) auth()->user()->is_active) == 0)>Tidak Aktif</option>
                    </select>
                    <p class="mt-2 text-xs text-slate-400">Jika akun dinonaktifkan, Anda tidak dapat login sampai diaktifkan
                        kembali.</p>
                    @error('is_active')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-5 py-2.5 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">
                    Simpan Profil
                </button>
            </form>
        </article>

        <article class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
            <h2 class="mb-1 text-2xl font-bold text-white">Ganti Password</h2>
            <p class="mb-6 text-sm text-slate-300">Masukkan password lama dan password baru Anda.</p>

            <form method="POST" action="{{ route('account.password.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="mb-2 block text-sm font-semibold text-slate-200">Password Saat
                        Ini</label>
                    <input id="current_password" type="password" name="current_password"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        required>
                    @error('current_password')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-200">Password Baru</label>
                    <input id="password" type="password" name="password"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        required>
                    @error('password')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-200">Konfirmasi
                        Password Baru</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                        required>
                </div>

                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-5 py-2.5 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">
                    Simpan Password
                </button>
            </form>
        </article>
    </section>
@endsection
