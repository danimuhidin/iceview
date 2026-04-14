@extends('layouts.panel')

@section('title', 'Edit Garansi User | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6">
            <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">User Feature</p>
            <h1 class="text-2xl font-bold text-white">Edit Garansi</h1>
            <p class="mt-1 text-sm text-slate-300">Hanya nama customer dan email yang dapat diubah oleh user.</p>
        </div>

        <form method="POST" action="{{ route('user.warranties.update', $warranty) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Nama Customer</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $warranty->customer_name) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Email Customer</label>
                    <input type="email" name="customer_email"
                        value="{{ old('customer_email', $warranty->customer_email) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Tipe Mobil</label>
                    <input type="text" value="{{ $warranty->car_type }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#0f1a2f] px-3 py-2 text-sm text-slate-400 outline-none"
                        readonly>
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-200">Nomor Mesin</label>
                    <input type="text" value="{{ $warranty->engine_number }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#0f1a2f] px-3 py-2 text-sm text-slate-400 outline-none"
                        readonly>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-5 py-2.5 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Update
                    Garansi</button>
                <a href="{{ route('user.warranties.show', $warranty) }}"
                    class="rounded-md border border-slate-500/50 px-5 py-2.5 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Kembali</a>
            </div>
        </form>
    </section>
@endsection
