@extends('layouts.panel')

@section('title', 'Buat Garansi | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8" x-data="{
        selectedPositions: @js(old('item_positions', [])),
        positions: @js($positions)
    }">
        <div class="mb-6">
            <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">User Feature</p>
            <h1 class="text-2xl font-bold text-white">Buat Garansi Baru</h1>
            <p class="mt-1 text-sm text-slate-300">Isi data customer dan pilih kaca yang ikut digaransi.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                <p class="font-semibold">Data belum valid.</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.warranties.store') }}" class="space-y-6">
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Nama Customer</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                    @error('customer_name')
                        <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Email Customer</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                    @error('customer_email')
                        <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Tipe Mobil</label>
                    <input type="text" name="car_type" value="{{ old('car_type') }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                    @error('car_type')
                        <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Nomor Mesin</label>
                    <input type="text" name="engine_number" value="{{ old('engine_number') }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                    @error('engine_number')
                        <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Nomor Polisi</label>
                    <input type="text" name="license_plate_number" value="{{ old('license_plate_number') }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                    @error('license_plate_number')
                        <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-white">Pilih Item Garansi</h2>
                    <p class="text-sm text-slate-400">Centang posisi kaca lalu pilih produk aktif untuk masing-masing item.
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    @foreach ($positions as $position)
                        <div class="rounded-xl border border-slate-700/60 bg-[#111d33] p-4">
                            <label class="flex items-center gap-3 text-sm font-semibold text-white">
                                <input type="checkbox" value="{{ $position }}" name="item_positions[]"
                                    x-model="selectedPositions"
                                    class="h-4 w-4 rounded border-slate-500 bg-transparent text-[#00F0FF] focus:ring-[#00F0FF]">
                                {{ $position }}
                            </label>
                            <div x-show="selectedPositions.includes(@js($position))" x-transition
                                class="mt-3">
                                <label class="mb-2 block text-xs uppercase tracking-wider text-slate-400">Produk</label>
                                <select name="product_ids[{{ $position }}]"
                                    :required="selectedPositions.includes(@js($position))"
                                    class="w-full rounded-md border border-slate-500/40 bg-[#0b1222] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                                    <option value="">Pilih produk aktif</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @selected((string) old('product_ids.' . $position) === (string) $product->id)>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_ids.' . $position)
                                    <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-5 py-2.5 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Simpan
                    Garansi</button>
                <a href="{{ route('user.warranties.index') }}"
                    class="rounded-md border border-slate-500/50 px-5 py-2.5 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Kembali</a>
            </div>
        </form>
    </section>
@endsection
