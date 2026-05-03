@extends('layouts.landing')

@section('title', config('app.name', 'ICE VIEW INDONESIA') . ' | Kaca Film Nano Ceramic Premium')

@section('main')
    <section id="home" class="relative overflow-hidden px-4 pb-14 pt-16 sm:px-5 lg:px-8 lg:pb-20 lg:pt-24">
        <div class="pointer-events-none absolute -right-12 top-20 h-48 w-48 rounded-full bg-cyan-400/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -left-10 bottom-10 h-36 w-36 rounded-full bg-slate-500/20 blur-2xl"></div>

        <div class="mx-auto grid w-full max-w-7xl items-center gap-10 lg:grid-cols-2">
            <div>
                <p class="reveal brand-font mb-3 text-sm font-semibold uppercase text-slate-300">ICE VIEW Windows Protection
                </p>
                <h1
                    class="reveal delay-1 brand-font mb-5 text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">

                    <span class="text-[#00F0FF]">BORN TO PROTECT</span>
                </h1>
                <p class="reveal delay-2 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base">
                    Menghadirkan teknologi Nano Ceramic untuk perlindungan kendaraan dan bangunan dari panas matahari dengan
                    kualitas superior dan harga terjangkau.
                </p>
                <div class="reveal delay-3 mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('products') }}"
                        class="rounded-md bg-[#00F0FF] px-6 py-3 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Explore
                        Products</a>
                    <a href="{{ route('dealers') }}"
                        class="rounded-md border border-slate-500/45 px-6 py-3 text-sm font-semibold text-white transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Find
                        Dealer</a>
                </div>
            </div>

            <div class="reveal delay-2">
                <div class="glass-card relative overflow-hidden rounded-2xl p-3">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-300/10 via-transparent to-slate-400/10"></div>
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1400&q=80"
                        alt="Premium Car" class="h-[320px] w-full rounded-xl object-cover sm:h-[430px]">
                    <div
                        class="absolute bottom-4 left-4 rounded-lg bg-[#020617]/85 px-4 py-3 text-[#F8FAFC] sm:bottom-6 sm:left-6">
                        <p class="brand-font text-xs uppercase tracking-widest text-[#00F0FF]">Heat Rejection Up To</p>
                        <p class="text-2xl font-bold">99%</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="px-4 py-14 sm:px-5 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl rounded-3xl border border-slate-600/40 bg-[#0b1222]/70 p-6 sm:p-8 lg:p-12">
            <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                <div>
                    <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Ice View Windows Protection</p>
                    <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">Teknologi Perlindungan yang Dibangun untuk
                        Iklim Tropis</h2>
                    <p class="text-sm leading-relaxed text-slate-300 sm:text-base">
                        Ice View adalah brand kaca film premium yang dirancang untuk membantu kabin tetap nyaman di bawah
                        terik matahari.
                        Dengan pendekatan material modern dan pemasangan yang presisi, Ice View menghadirkan perlindungan
                        yang terasa nyata
                        pada pemakaian harian, baik untuk kendaraan pribadi maupun armada operasional.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-slate-300 sm:text-base">
                        Fokus utama kami adalah memberikan keseimbangan antara estetika, kenyamanan, dan performa, sehingga
                        pengguna bisa
                        merasakan kabin yang lebih adem tanpa mengorbankan tampilan mobil yang elegan.
                    </p>
                </div>


                <div class="glass-card overflow-hidden rounded-2xl p-3">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1400&q=80"
                        alt="Nano ceramic illustration" class="h-full min-h-[320px] w-full rounded-xl object-cover">
                </div>
            </div>

            <div class="mt-8">
                <div class="glass-card rounded-2xl p-6">
                    <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Nano Ceramic Technology</p>
                    <h3 class="mb-4 text-2xl font-bold text-white">Performa Lebih Dingin, Perlindungan Lebih Menyeluruh</h3>
                    <p class="text-sm leading-relaxed text-slate-300 sm:text-base">
                        Nano ceramic window film bekerja dengan partikel mikroskopis yang membantu menahan panas matahari,
                        mengurangi silau, dan memblokir sebagian besar sinar UV yang merusak. Hasilnya, AC tidak bekerja
                        terlalu berat,
                        interior lebih terlindungi, dan perjalanan terasa lebih nyaman di cuaca panas.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-slate-300 sm:text-base">
                        Anda akan merasakan kombinasi antara penolakan panas yang efektif, kejernihan pandang yang tetap
                        nyaman,
                        serta tampilan yang rapi dan premium. Untuk pengemudi yang menginginkan kenyamanan maksimal dengan
                        visual modern,
                        nano ceramic adalah pilihan yang paling seimbang.
                    </p>

                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-lg border border-slate-500/35 bg-[#111d33] p-4">
                            <p class="text-sm font-semibold text-white">Advance Cooling Technology</p>
                            <p class="mt-1 text-xs text-slate-300">Membantu kabin lebih sejuk di hari yang terik.</p>
                        </div>
                        <div class="rounded-lg border border-slate-500/35 bg-[#111d33] p-4">
                            <p class="text-sm font-semibold text-white">UV Protection</p>
                            <p class="mt-1 text-xs text-slate-300">Membantu menahan sinar UV yang merusak interior.</p>
                        </div>
                        <div class="rounded-lg border border-slate-500/35 bg-[#111d33] p-4">
                            <p class="text-sm font-semibold text-white">Mengurangi Silau</p>
                            <p class="mt-1 text-xs text-slate-300">Membuat pandangan lebih nyaman saat berkendara.</p>
                        </div>
                        <div class="rounded-lg border border-slate-500/35 bg-[#111d33] p-4">
                            <p class="text-sm font-semibold text-white">Menambah Privasi</p>
                            <p class="mt-1 text-xs text-slate-300">Memberi kesan aman dan tampilan lebih eksklusif.</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section id="products" class="px-4 py-14 sm:px-5 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl">
            <h2 class="brand-font mb-3 text-3xl font-bold text-white">Products</h2>
            <p class="mb-8 text-sm text-slate-300 sm:text-base">Pilih seri produk yang sesuai dengan kebutuhan
                performa dan visual kendaraan Anda.</p>

            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                <article class="glass-card rounded-2xl p-6">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80"
                        alt="Iceview Solar Shield" class="mb-4 h-44 w-full rounded-xl object-cover">
                    {{-- <p class="brand-font mb-2 text-xs uppercase tracking-widest text-slate-300">Signature Series</p> --}}
                    <h3 class="mb-3 text-xl font-semibold text-white">Ice View Platinum</h3>
                    <p class="mb-5 text-sm text-slate-300">Hadir dikelas entry level produk kami, dengan teknologi nano
                        ceramic yang memiliki tolak panas yang terbaik untuk kendaraan dan gedung dikelasnya.</p>
                    {{-- <span class="inline-flex rounded-md bg-[#00F0FF]/20 px-3 py-1 text-xs font-semibold text-[#c6faff]">High
                        Heat Rejection</span> --}}
                </article>

                <article class="glass-card rounded-2xl p-6">
                    <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1200&q=80"
                        alt="Iceview Ceramic Pro" class="mb-4 h-44 w-full rounded-xl object-cover">
                    {{-- <p class="brand-font mb-2 text-xs uppercase tracking-widest text-slate-300">Elite Series</p> --}}
                    <h3 class="mb-3 text-xl font-semibold text-white">Ice View Premium</h3>
                    <p class="mb-5 text-sm text-slate-300">hadir sebagai Produk unggulan kami, dengan teknologi nano
                        ceramic, namun memiliki tolak panas yang lebih baik dari Ice View Platinum, memberikan kenyamanan
                        yang maksimal.</p>
                    {{-- <span
                        class="inline-flex rounded-md bg-[#00F0FF]/20 px-3 py-1 text-xs font-semibold text-[#c6faff]">Signal
                        Friendly</span> --}}
                </article>

                <article class="glass-card rounded-2xl p-6">
                    <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80"
                        alt="Iceview Safety Guard" class="mb-4 h-44 w-full rounded-xl object-cover">
                    {{-- <p class="brand-font mb-2 text-xs uppercase tracking-widest text-slate-300">Security Series</p> --}}
                    <h3 class="mb-3 text-xl font-semibold text-white">Super Clear</h3>
                    <p class="mb-5 text-sm text-slate-300">Hadir dalam tingkat kecerahan 20% atau bisa disebut "clear".
                        produk kami menawarkan tolak panas yang maksimal di angka 94%, namun dengan harga yang relatif lebih
                        hemat.</p>
                    {{-- <span
                        class="inline-flex rounded-md bg-[#00F0FF]/20 px-3 py-1 text-xs font-semibold text-[#c6faff]">Safety
                        Layer</span> --}}
                </article>
            </div>
        </div>
    </section>

    <section id="waranty" class="px-4 pb-16 pt-14 sm:px-5 lg:px-8 lg:pb-24 lg:pt-20">
        <div
            class="mx-auto max-w-7xl rounded-3xl border border-slate-600/45 bg-gradient-to-r from-[#0c1426] via-[#0f172a] to-[#1e293b] p-6 sm:p-8 lg:p-12">
            <h2 class="brand-font mb-3 text-3xl font-bold text-white">Warranty</h2>
            <p class="mb-6 max-w-3xl text-sm leading-relaxed text-slate-300 sm:text-base">
                Setiap pemasangan resmi mendapatkan perlindungan warranty sesuai ketentuan produk. Klaim lebih mudah melalui
                dealer resmi dengan verifikasi nomor seri.
            </p>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                    <p class="brand-font text-lg font-bold text-white">Jaminan Kualitas & Kenyamanan</p>
                    <p class="text-sm text-slate-300">
                        Dengan garansi yang mencapai 5 tahun meliputi warna dan kemampuan tolak panas memberikan anda
                        kemananan dan juga kenyamanan sebagai pilihan terbaik dikelasnya.
                    </p>
                </div>
                <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                    <p class="brand-font text-lg font-bold text-white">Aktivasi E-Warranty & Keaslian</p>
                    <p class="text-sm text-slate-300">
                        Registrasi E-Warranty anda untuk mendapatkan perlindungan garansi terbaik selama 5 tahun dan juga
                        untuk memastikan keaslian produk ICE VIEW yang terpasang di kendaraan anda.
                    </p>
                </div>
                <div class="rounded-xl border border-slate-500/35 bg-[#111d33] p-4">
                    <p class="brand-font text-lg font-bold text-white">Garansi & Layanan Dealer</p>
                    <p class="text-sm text-slate-300">
                        Setiap produk ICE VIEW yang terpasang di dealer resmi mendapatkan garansi 5 tahun untuk jasa dan
                        produk, hubungi dealer resmi tempat anda membeli untuk mendapatkan pelayanan garansi.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
