@extends('layouts.landing')

@section('title', 'Dealers | Iceview')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl">
            <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Dealers</p>
            <h1 class="mb-4 text-4xl font-bold text-white sm:text-5xl">Temukan Dealer Iceview Terdekat Anda</h1>
            <p class="text-sm leading-relaxed text-slate-300 sm:text-base">
                Dealer resmi Iceview merupakan partner yang telah disiapkan untuk memberikan pengalaman pemasangan yang
                rapi,
                konsultasi produk yang tepat, dan layanan purna jual yang lebih nyaman. Pilih dealer terdekat untuk
                mendapatkan
                hasil pemasangan yang konsisten dan dukungan yang sesuai kebutuhan kendaraan Anda.
            </p>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($dealers as $dealer)
                    @php
                        $whatsapp = 'https://wa.me/' . preg_replace('/\D+/', '', $dealer['phone']);
                    @endphp
                    <article class="glass-card rounded-3xl p-6">
                        <h2 class="mb-1 text-xl font-bold text-white">{{ $dealer['name'] }}</h2>
                        <p class="mb-4 text-sm text-slate-300">{{ $dealer['city'] }}</p>

                        <div class="space-y-3 text-sm text-slate-300">
                            <p>
                                <span class="block text-xs uppercase tracking-wider text-slate-500">Alamat</span>
                                <a href="{{ $dealer['maps'] }}" target="_blank" rel="noopener noreferrer"
                                    class="text-cyan-300 transition hover:text-cyan-200">
                                    {{ $dealer['address'] }}
                                </a>
                            </p>
                            <p>
                                <span class="block text-xs uppercase tracking-wider text-slate-500">No Telp</span>
                                <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer"
                                    class="text-cyan-300 transition hover:text-cyan-200">
                                    {{ $dealer['phone'] }}
                                </a>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <article class="mt-8 glass-card rounded-3xl p-6 sm:p-8 lg:p-10">
                <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Hubungi Tim Kami</p>
                <h2 class="mb-4 text-3xl font-bold text-white">Dealer Resmi yang Siap Membantu Anda</h2>
                <p class="max-w-4xl text-sm leading-relaxed text-slate-300 sm:text-base">
                    Dealer Iceview adalah partner terlatih yang siap membantu Anda mendapatkan pemasangan yang presisi,
                    produk yang sesuai kebutuhan, serta pengalaman layanan yang nyaman dari awal sampai akhir.
                    Kami percaya hasil terbaik lahir dari kombinasi produk asli, tenaga profesional, dan dukungan
                    after-sales yang jelas.
                </p>

                <div class="mt-8 grid gap-5 lg:grid-cols-2">
                    <div>
                        <h3 class="mb-3 text-xl font-semibold text-white">Mengapa Memilih Dealer Resmi?</h3>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="font-semibold text-white">Pemasangan bersertifikat</p>
                                <p class="mt-1 text-sm text-slate-300">Ditangani oleh teknisi terlatih.</p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="font-semibold text-white">Produk asli dengan garansi</p>
                                <p class="mt-1 text-sm text-slate-300">Perlindungan resmi dan kualitas terjamin.</p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="font-semibold text-white">Konsultasi ahli</p>
                                <p class="mt-1 text-sm text-slate-300">Rekomendasi produk sesuai kebutuhan kendaraan Anda.
                                </p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="font-semibold text-white">Layanan purna jual</p>
                                <p class="mt-1 text-sm text-slate-300">Dukungan setelah pemasangan tetap tersedia.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-3 text-xl font-semibold text-white">Proses Pemasangan</h3>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="brand-font mb-2 text-xs uppercase tracking-widest text-cyan-300">01</p>
                                <p class="font-semibold text-white">Konsultasi</p>
                                <p class="mt-1 text-sm text-slate-300">Penilaian kebutuhan dan pemilihan produk.</p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="brand-font mb-2 text-xs uppercase tracking-widest text-cyan-300">02</p>
                                <p class="font-semibold text-white">Persiapan</p>
                                <p class="mt-1 text-sm text-slate-300">Pembersihan dan penyiapan permukaan.</p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="brand-font mb-2 text-xs uppercase tracking-widest text-cyan-300">03</p>
                                <p class="font-semibold text-white">Pemasangan</p>
                                <p class="mt-1 text-sm text-slate-300">Aplikasi profesional menggunakan alat khusus.</p>
                            </div>
                            <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                                <p class="brand-font mb-2 text-xs uppercase tracking-widest text-cyan-300">04</p>
                                <p class="font-semibold text-white">Pemeriksaan</p>
                                <p class="mt-1 text-sm text-slate-300">Inspeksi kualitas dan pembersihan akhir.</p>
                            </div>
                        </div>
                        <div class="mt-4 rounded-xl border border-cyan-500/30 bg-cyan-500/10 p-4 text-sm text-cyan-100">
                            Garansi komprehensif hingga 5 tahun tersedia untuk produk dan pemasangan tertentu sesuai
                            ketentuan dealer.
                        </div>
                    </div>
                </div>
            </article>


        </div>
    </section>
@endsection
