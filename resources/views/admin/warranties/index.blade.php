@extends('layouts.panel')

@section('title', 'Admin Garansi | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">Daftar Garansi</h1>
                <p class="mt-1 text-sm text-slate-300">Pantau semua garansi yang masuk dari seluruh user.</p>
            </div>
            <a href="{{ route('admin.claims.index') }}"
                class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Lihat
                Pending Claim</a>
        </div>

        <form method="GET" action="{{ route('admin.warranties.index') }}"
            class="mb-5 grid gap-3 rounded-xl border border-slate-700/60 bg-[#0f1a2f] p-4 md:grid-cols-[1fr_auto]">
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari customer, kode, nomor mesin, pol..."
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Filter</button>
                <a href="{{ route('admin.warranties.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Kode Garansi</th>
                        <th class="px-4 py-3 text-left font-semibold">User</th>
                        <th class="px-4 py-3 text-left font-semibold">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold">No Mesin</th>
                        <th class="px-4 py-3 text-left font-semibold">Nopol</th>
                        <th class="px-4 py-3 text-left font-semibold">Item</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($warranties as $warranty)
                        <tr>
                            <td class="px-4 py-4 font-semibold text-white">{{ $warranty->warranty_code }}</td>
                            <td class="px-4 py-4">{{ $warranty->dealer?->name ?: '-' }}</td>
                            <td class="px-4 py-4">{{ $warranty->customer_name }}<div class="text-xs text-slate-400">
                                    {{ $warranty->customer_email }}</div>
                            </td>
                            <td class="px-4 py-4">{{ $warranty->engine_number }}</td>
                            <td class="px-4 py-4">{{ $warranty->license_plate_number ?: '-' }}</td>
                            <td class="px-4 py-4">{{ $warranty->items_count }}</td>
                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.warranties.show', $warranty) }}"
                                        class="rounded-md border border-slate-500/50 px-3 py-1.5 text-xs text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Detail</a>
                                    <a href="{{ route('admin.warranties.edit', $warranty) }}"
                                        class="rounded-md border border-slate-500/50 px-3 py-1.5 text-xs text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada data garansi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $warranties->links() }}</div>
    </section>
@endsection
