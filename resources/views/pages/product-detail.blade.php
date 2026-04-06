@extends('layouts.landing')

@section('title', $product['name'] . ' | Iceview')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-5xl">
            <a href="{{ route('products') }}"
                class="mb-5 inline-flex text-sm font-semibold text-cyan-300 hover:text-cyan-200">Kembali ke Products</a>
            <article class="glass-card rounded-2xl p-6 sm:p-8">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                    class="mb-6 h-72 w-full rounded-2xl object-cover">
                <p class="brand-font mb-2 text-xs uppercase tracking-widest text-slate-300">{{ $product['series'] }}</p>
                <h1 class="mb-4 text-3xl font-bold text-white">{{ $product['name'] }}</h1>
                <p class="mb-6 text-sm leading-relaxed text-slate-300">{{ $product['description'] }}</p>

                <h2 class="mb-3 text-lg font-semibold text-white">Fitur Utama</h2>
                <ul class="space-y-2 text-sm text-slate-300">
                    @foreach ($product['features'] as $feature)
                        <li>- {{ $feature }}</li>
                    @endforeach
                </ul>

                <div class="mt-6 rounded-lg border border-cyan-500/30 bg-cyan-500/10 px-4 py-3 text-sm text-cyan-200">
                    Kategori: {{ $product['tag'] }}
                </div>
            </article>
        </div>
    </section>
@endsection
