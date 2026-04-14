@extends('layouts.landing')

@section('title', 'Cek Garansi | Ice View Indonesia')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="glass-card reveal rounded-3xl p-6 sm:p-8">
                <p class="brand-font text-sm uppercase tracking-[0.3em] text-[#00F0FF]">Cek Garansi</p>
                <h1 class="mt-2 text-xl font-bold text-white sm:text-xl">Cari Garansi dengan Nomor Mesin atau Kode Garansi
                </h1>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">Masukkan salah satu identitas untuk menampilkan
                    histori lengkap garansi kaca film mobil.</p>

                @if ($errors->any())
                    <div class="mt-5 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                        {{ $errors->first('search') }}
                    </div>
                @endif

                <form action="{{ route('warranty.check.process') }}" method="POST"
                    class="mt-6 grid gap-4 sm:grid-cols-[1fr_auto]">
                    @csrf
                    <input type="text" name="search" value="{{ old('search') }}"
                        placeholder="Nomor Mesin atau Kode Garansi"
                        class="w-full rounded-xl border border-slate-500/40 bg-[#111d33] px-4 py-3 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                    <button type="submit"
                        class="rounded-xl bg-[#00F0FF] px-6 py-3 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Cari</button>
                </form>
            </div>
        </div>
    </section>
@endsection
