@extends('layouts.landing')

@section('title', 'Hasil Garansi | Ice View Indonesia')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="glass-card reveal rounded-3xl p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="brand-font text-sm uppercase tracking-[0.3em] text-[#00F0FF]">Hasil Pencarian</p>
                        <h1 class="mt-2 text-3xl font-bold text-white">Riwayat Garansi Kaca Film</h1>
                        <p class="mt-2 text-sm text-slate-300">Pencarian: <span
                                class="font-semibold text-white">{{ $search }}</span></p>
                    </div>
                    <a href="{{ route('waranty') }}"
                        class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Cari
                        Lagi</a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nomor Rangka</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $engineNumber }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Garansi Terakhir</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $primaryWarranty->warranty_code }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Customer</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $primaryWarranty->customer_name }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tipe Mobil</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $primaryWarranty->car_type }}</p>
                    </div>
                </div>
            </div>

            @foreach ($warranties as $warranty)
                <div class="glass-card reveal rounded-3xl p-6 sm:p-8 delay-{{ min($loop->iteration, 3) }}">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="brand-font text-sm uppercase tracking-[0.3em] text-[#00F0FF]">
                                {{ $warranty->warranty_code }}</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">{{ $warranty->customer_name }}</h2>
                            <p class="mt-1 text-sm text-slate-300">{{ $warranty->customer_email }} ·
                                {{ $warranty->car_type }}</p>
                        </div>
                        <div class="rounded-xl border border-slate-700/60 bg-[#0f1a2f] px-4 py-3 text-sm text-slate-300">
                            Dealer: <span class="font-semibold text-white">{{ $warranty->dealer?->name ?: '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-6 overflow-x-auto rounded-2xl border border-slate-700/60">
                        <table class="min-w-full divide-y divide-slate-700 text-sm">
                            <thead class="bg-[#111d33] text-slate-200">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Posisi</th>
                                    <th class="px-4 py-3 text-left font-semibold">Produk</th>
                                    <th class="px-4 py-3 text-left font-semibold">Expired At</th>
                                    <th class="px-4 py-3 text-left font-semibold">Sisa Waktu</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                                @forelse ($warranty->items as $item)
                                    @php
                                        $isFuture = $item->expired_at->isFuture();
                                        $interval = $isFuture ? now()->diff($item->expired_at) : null;
                                        $remainingParts = [];
                                        if ($interval) {
                                            if ($interval->y > 0) {
                                                $remainingParts[] = $interval->y . ' Tahun';
                                            }
                                            if ($interval->m > 0) {
                                                $remainingParts[] = $interval->m . ' Bulan';
                                            }
                                            if ($interval->d > 0 && count($remainingParts) < 2) {
                                                $remainingParts[] = $interval->d . ' Hari';
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-4 font-semibold text-white">{{ $item->item_position }}</td>
                                        <td class="px-4 py-4">{{ $item->product_name }}</td>
                                        <td class="px-4 py-4">{{ $item->expired_at->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-4">
                                            {{ $isFuture ? 'Sisa ' . implode(' ', array_slice($remainingParts, 0, 2)) : 'Sudah Kedaluwarsa' }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <span
                                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'Active' ? 'bg-emerald-500/20 text-emerald-200' : ($item->status === 'Pending Claim' ? 'bg-amber-500/20 text-amber-200' : 'bg-slate-600/50 text-slate-200') }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-slate-400">Belum ada item
                                            garansi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="glass-card reveal rounded-3xl p-6 sm:p-8 text-slate-300 mt-8">
                <h3 class="text-xl font-bold text-white mb-4">Syarat & Ketentuan Garansi</h3>
                <p class="mb-2 font-semibold">Garansi Tidak Berlaku dan Batal Apabila:</p>
                <ul class="list-disc pl-5 space-y-1 mb-4">
                    <li>Pemasangan Bukan Dilakukan oleh Cabang Resmi ICEVIEW INDONESIA.</li>
                    <li>Pembeli Tidak Melakukan Perawatan Sesuai Dengan Petunjuk yang diberikan.</li>
                    <li>Kaca Film Rusak Akibat Kelalaian Pembeli, Bencana Alam, Kebakaran & Kecelakaan.</li>
                    <li>Kartu Garansi Di Pindahtangankan.</li>
                    <li>Terjadi Rangkap Dua (Double) Terhadap Kaca Film Apapun.</li>
                </ul>
                <p class="text-sm bg-slate-800/50 p-4 rounded-lg border border-slate-700/50">
                    <strong class="text-[#00F0FF]">Catatan Penting:</strong> Penggantian Klaim Kaca Film Di Atas 1 (Satu)
                    Tahun Akan Dikenakan Biaya Pemasangan.
                </p>
            </div>
        </div>
    </section>
@endsection
