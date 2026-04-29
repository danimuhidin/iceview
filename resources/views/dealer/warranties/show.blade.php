@extends('layouts.panel')

@section('title', 'Detail Garansi User | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">User Feature</p>
                <h1 class="text-2xl font-bold text-white">{{ $warranty->warranty_code }}</h1>
                <p class="mt-1 text-sm text-slate-300">Detail garansi dan daftar item kaca yang terdaftar.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('user.warranties.edit', $warranty) }}"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Edit</a>
                <a href="{{ route('user.warranties.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Kembali</a>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Customer</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->customer_name }}</p>
                <p class="text-sm text-slate-400">{{ $warranty->customer_email }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tipe Mobil</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->car_type }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nomor Rangka</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->engine_number }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nomor Polisi</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->license_plate_number ?: '-' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">User</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->dealer?->name ?: '-' }}</p>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Posisi</th>
                        <th class="px-4 py-3 text-left font-semibold">Produk</th>
                        <th class="px-4 py-3 text-left font-semibold">Expired At</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($warranty->items as $item)
                        @php
                            $isClaimable = $item->status === 'Active' && $item->expired_at->isFuture();
                        @endphp
                        <tr>
                            <td class="px-4 py-4 font-semibold text-white">{{ $item->item_position }}</td>
                            <td class="px-4 py-4">{{ $item->product_name }}</td>
                            <td class="px-4 py-4">{{ $item->expired_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-4"><span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'Active' ? 'bg-emerald-500/20 text-emerald-200' : ($item->status === 'Pending Claim' ? 'bg-amber-500/20 text-amber-200' : 'bg-slate-600/50 text-slate-200') }}">{{ $item->status_label }}</span>
                            </td>
                            <td class="px-4 py-4" x-data="{ claimModalOpen: false }">
                                @if ($isClaimable)
                                    <button type="button" @click="claimModalOpen = true"
                                        class="rounded-md border border-amber-400/60 px-3 py-1.5 text-xs font-semibold text-amber-200 transition hover:bg-amber-400/10">Ajukan
                                        Klaim</button>

                                    <div x-show="claimModalOpen" x-transition.opacity x-cloak
                                        class="fixed inset-0 z-40 bg-black/60" @click="claimModalOpen = false"></div>

                                    <div x-show="claimModalOpen" x-transition x-cloak
                                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                                        @keydown.escape.window="claimModalOpen = false">
                                        <div class="w-full max-w-md max-h-[90vh] overflow-y-auto rounded-2xl border border-slate-700 bg-[#0b1222] p-6 shadow-2xl shadow-black/50"
                                            @click.stop>
                                            <h3 class="text-lg font-bold text-white">Konfirmasi Klaim</h3>
                                            <p class="mt-2 text-sm text-slate-300">Ajukan klaim untuk item
                                                <span class="font-semibold text-white">{{ $item->item_position }}</span>
                                                dengan produk
                                                <span class="font-semibold text-white">{{ $item->product_name }}</span>?
                                            </p>

                                            <div class="mt-5 flex justify-end gap-2">
                                                <button type="button" @click="claimModalOpen = false"
                                                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Batal</button>

                                                <form action="{{ route('user.warranties.claim', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="rounded-md bg-amber-500 px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Ya,
                                                        Ajukan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada item garansi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
