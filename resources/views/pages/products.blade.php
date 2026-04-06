@extends('layouts.landing')

@section('title', 'Products | Iceview')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-7xl">
            <p class="brand-font mb-2 text-sm uppercase tracking-wider text-cyan-300">Products</p>
            <h1 class="mb-8 text-4xl font-bold text-white">Pilihan Produk Iceview</h1>

            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <article class="glass-card rounded-2xl p-6">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                            class="mb-4 h-44 w-full rounded-xl object-cover">
                        <p class="brand-font mb-2 text-xs uppercase tracking-widest text-slate-300">{{ $product['series'] }}
                        </p>
                        <h2 class="mb-3 text-xl font-semibold text-white">{{ $product['name'] }}</h2>
                        <p class="mb-4 text-sm text-slate-300">{{ $product['description'] }}</p>
                        <span
                            class="inline-flex rounded-md bg-cyan-500/20 px-3 py-1 text-xs font-semibold text-cyan-200">{{ $product['tag'] }}</span>
                        <div class="mt-5">
                            <a href="{{ route('products.detail', $product['slug']) }}"
                                class="text-sm font-semibold text-cyan-300 transition hover:text-cyan-200">Lihat Detail</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
