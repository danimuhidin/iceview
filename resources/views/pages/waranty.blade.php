@extends('layouts.landing')

@section('title', 'Waranty | Ice View Indonesia')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-6xl">
            <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Waranty</p>
            <h1 class="mb-6 text-4xl font-bold text-white">Program Waranty Resmi Iceview</h1>

            <div class="grid gap-5 md:grid-cols-3">
                <div class="glass-card rounded-2xl p-6">
                    <h2 class="mb-2 text-lg font-semibold text-white">Coverage</h2>
                    <p class="text-sm text-slate-300">Mencakup perubahan warna, peeling, dan cacat material sesuai ketentuan
                        produk.</p>
                </div>
                <div class="glass-card rounded-2xl p-6">
                    <h2 class="mb-2 text-lg font-semibold text-white">Validity</h2>
                    <p class="text-sm text-slate-300">Masa warranty hingga 5 tahun untuk seri tertentu dengan pemasangan
                        resmi.</p>
                </div>
                <div class="glass-card rounded-2xl p-6">
                    <h2 class="mb-2 text-lg font-semibold text-white">Claim Process</h2>
                    <p class="text-sm text-slate-300">Klaim dilakukan melalui dealer resmi dengan verifikasi nomor seri dan
                        inspeksi unit.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
