@extends('layouts.panel')

@section('title', 'Pending Claim | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">Pending Claim</h1>
                <p class="mt-1 text-sm text-slate-300">Daftar item garansi yang sedang menunggu persetujuan klaim.</p>
            </div>
            <a href="{{ route('admin.warranties.index') }}"
                class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Semua
                Garansi</a>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Kode Garansi</th>
                        <th class="px-4 py-3 text-left font-semibold">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold">User</th>
                        <th class="px-4 py-3 text-left font-semibold">Posisi</th>
                        <th class="px-4 py-3 text-left font-semibold">Produk</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($pendingClaims as $item)
                        <tr>
                            <td class="px-4 py-4 font-semibold text-white">{{ $item->warranty?->warranty_code }}</td>
                            <td class="px-4 py-4">{{ $item->warranty?->customer_name }}</td>
                            <td class="px-4 py-4">{{ $item->warranty?->dealer?->name ?: '-' }}</td>
                            <td class="px-4 py-4">{{ $item->item_position }}</td>
                            <td class="px-4 py-4">{{ $item->product_name }}</td>
                            <td class="px-4 py-4">
                                <form action="{{ route('admin.warranties.claims.approve', $item->id) }}" method="POST"
                                    data-confirm-message="Setujui klaim item ini?">
                                    @csrf
                                    <button type="submit"
                                        class="rounded-md bg-[#00F0FF] px-3 py-1.5 text-xs font-semibold text-[#0F172A] transition hover:brightness-110">Approve</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">Tidak ada item pending claim.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $pendingClaims->links() }}</div>
    </section>
@endsection
