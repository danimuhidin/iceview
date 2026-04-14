@extends('layouts.panel')

@section('title', 'Admin Dashboard | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <p class="brand-font mb-2 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Panel</p>
        <h1 class="mb-3 text-3xl font-bold text-white">Welcome, {{ auth()->user()->name }}</h1>
        <p class="mb-8 text-sm text-slate-300 sm:text-base">Kelola konten, pantau dealer, dan atur operasional website dari
            dashboard admin.</p>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Total Users</p>
                <p class="mt-2 text-2xl font-bold text-white">128</p>
            </div>
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Total Dealers</p>
                <p class="mt-2 text-2xl font-bold text-white">42</p>
            </div>
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Warranty Claims</p>
                <p class="mt-2 text-2xl font-bold text-white">17</p>
            </div>
            <div class="rounded-xl border border-slate-600/50 bg-[#111d33] p-4">
                <p class="text-sm text-slate-300">Pending Requests</p>
                <p class="mt-2 text-2xl font-bold text-white">9</p>
            </div>
        </div>
    </section>
@endsection
