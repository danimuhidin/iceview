@extends('layouts.app')

@section('title', 'Login | Iceview')

@section('content')
    <div class="w-full max-w-md rounded-2xl border border-slate-600/40 bg-[#0b1222]/85 p-6 shadow-2xl shadow-black/40 sm:p-8"
        x-data="{ loading: false }">
        <div class="mb-6 text-center">
            <img src="{{ asset('iceview.png') }}" alt="Iceview" class="mx-auto mb-3 h-14 w-auto">
            <h2 class="brand-font text-3xl font-bold text-[#00F0FF]">Login</h2>
            <p class="mt-1 text-sm text-slate-300">Masuk untuk melanjutkan ke dashboard Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" @submit="loading = true" class="space-y-4">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-200">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                    required>
                @error('email')
                    <span class="mt-1 block text-xs text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-200">Password</label>
                <input type="password" name="password"
                    class="w-full rounded-lg border border-slate-500/40 bg-[#111d33] px-3 py-2 text-slate-100 outline-none transition focus:border-[#00F0FF] focus:ring-2 focus:ring-[#00F0FF]/30"
                    required>
            </div>

            <button type="submit"
                class="w-full rounded-lg bg-[#00F0FF] py-2.5 font-semibold text-[#0F172A] transition hover:brightness-110"
                x-bind:disabled="loading">
                <span x-show="!loading">Login</span>
                <span x-show="loading">Processing...</span>
            </button>
        </form>

        <a href="{{ url('/') }}"
            class="mt-4 inline-flex w-full items-center justify-center rounded-lg border border-slate-500/40 px-4 py-2 text-sm font-medium text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
            Kembali ke Halaman Utama
        </a>
    </div>
@endsection
