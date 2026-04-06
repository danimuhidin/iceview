@extends('layouts.landing')

@section('title', 'About Us | Iceview')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl">
            <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">About Us</p>
            <h1 class="mb-6 text-4xl font-bold text-white">Iceview Window Protection</h1>
            <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <article class="glass-card rounded-2xl p-6">
                    <h2 class="mb-3 text-xl font-semibold text-white">Tentang Iceview</h2>
                    <p class="text-sm leading-relaxed text-slate-300">
                        Iceview adalah brand kaca film premium yang fokus menghadirkan kenyamanan berkendara di iklim
                        tropis.
                        Kami merancang produk untuk membantu mengurangi panas, menjaga interior tetap terlindungi, dan tetap
                        mempertahankan tampilan mobil yang elegan.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-slate-300">
                        Melalui pemasangan yang rapi dan material pilihan, Iceview berusaha memberikan hasil yang seimbang
                        antara
                        performa, privasi, serta estetika modern untuk kendaraan harian maupun kebutuhan profesional.
                    </p>
                </article>

                <div class="glass-card overflow-hidden rounded-2xl p-3">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1400&q=80"
                        alt="Nano ceramic illustration" class="h-80 w-full rounded-xl object-cover">
                </div>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <article class="glass-card rounded-2xl p-6">
                    <h2 class="mb-3 text-xl font-semibold text-white">Nano Ceramic Technology</h2>
                    <p class="text-sm leading-relaxed text-slate-300">
                        Nano ceramic window film menggunakan partikel ultra-halus yang membantu menahan panas matahari,
                        meredam silau, dan memblokir sebagian besar paparan UV. Dengan begitu, AC tidak perlu bekerja
                        sekeras biasanya,
                        kabin terasa lebih nyaman, dan interior mobil mendapatkan perlindungan tambahan dari efek sinar
                        matahari yang berlebih.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-slate-300">
                        Teknologi ini cocok untuk pengguna yang menginginkan kesejukan, kejernihan pandang, dan tampilan
                        yang tetap premium.
                        Hasil akhirnya adalah perjalanan yang lebih nyaman tanpa mengorbankan gaya.
                    </p>
                </article>

                <article class="glass-card rounded-2xl p-6">
                    <h2 class="mb-3 text-xl font-semibold text-white">Manfaat Utama</h2>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li>Advance Cooling Technology</li>
                        <li>UV Protection</li>
                        <li>Mengurangi Silau</li>
                        <li>Menambah Privasi</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>
@endsection
