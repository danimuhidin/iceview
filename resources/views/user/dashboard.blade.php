@extends('layouts.panel')

@section('title', 'User Dashboard | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <p class="brand-font mb-2 text-sm uppercase tracking-wider text-[#00F0FF]">User Dashboard</p>
        <h1 class="mb-3 text-3xl font-bold text-white">Hi, {{ auth()->user()->name }}</h1>
        <p class="mb-8 text-sm text-slate-300 sm:text-base">Pantau informasi produk, status warranty, dan update terbaru dari
            Iceview.</p>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Warranty Status</p>
                <p class="mt-2 text-2xl font-bold text-white">Active</p>
            </div>
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Registered Vehicle</p>
                <p class="mt-2 text-2xl font-bold text-white">1 Unit</p>
            </div>
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Nearest Dealer</p>
                <p class="mt-2 text-2xl font-bold text-white">Jakarta</p>
            </div>
        </div>
    </section>
@endsection
