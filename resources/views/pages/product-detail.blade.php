@extends('layouts.landing')

@section('title', $product['name'] . ' | Ice View Indonesia')

@section('main')
    <section class="px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mx-auto max-w-6xl">
            <a href="{{ route('products') }}"
                class="mb-5 inline-flex text-sm font-semibold text-cyan-300 hover:text-cyan-200">Kembali ke Products</a>
            <article class="glass-card rounded-2xl p-6 sm:p-8">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                    class="mb-6 h-64 w-full rounded-2xl object-cover sm:h-72">
                <h1 class="mb-4 text-3xl font-bold text-white">{{ $product['name'] }}</h1>
                <p class="mb-6 text-sm leading-relaxed text-slate-300">{{ $product['description'] }}</p>

                <h2 class="mb-4 text-xl font-semibold text-white">Varian Sub Produk</h2>
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($product['sub_products'] as $subProduct)
                        <article class="metal-card rounded-xl p-4">
                            <img src="{{ $subProduct['image'] }}" alt="{{ $subProduct['name'] }}"
                                class="mb-4 h-44 w-full rounded-lg object-cover">
                            <h3 class="mb-2 text-lg font-semibold text-white">{{ $subProduct['name'] }}</h3>
                            <p class="mb-4 text-sm text-slate-300">{{ $subProduct['description'] }}</p>

                            <dl class="space-y-2 text-sm">
                                @foreach ($subProduct['specifications'] as $label => $value)
                                    <div
                                        class="flex items-start justify-between gap-3 border-b border-slate-700/60 pb-2 last:border-b-0 last:pb-0">
                                        <dt class="font-medium text-slate-300">{{ $label }}</dt>
                                        <dd class="text-right text-cyan-200">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </article>
                    @endforeach
                </div>
            </article>
        </div>
    </section>
@endsection
