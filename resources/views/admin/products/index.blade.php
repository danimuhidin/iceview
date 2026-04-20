@extends('layouts.panel')

@section('title', 'Manajemen Produk | Ice View Indonesia')

@section('content')
    <section x-data="{
        createOpen: false,
        manageOpen: false,
        selected: { id: null, name: '', status: 'Active' },
        openManage(product) {
            this.selected = product;
            this.manageOpen = true;
        }
    }" class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">Manajemen Produk</h1>
                <p class="mt-1 text-sm text-slate-300">Kelola master data produk untuk dropdown pembuatan garansi.</p>
            </div>
            <div class="flex items-center gap-2">
                <p class="rounded-md border border-slate-600/50 px-3 py-2 text-xs text-slate-300">Total:
                    {{ $products->total() }} produk</p>
                <button type="button" @click="createOpen = true"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Tambah
                    Produk</button>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.products.index') }}"
            class="mb-5 grid gap-3 rounded-xl border border-slate-700/60 bg-[#0f1a2f] p-4 md:grid-cols-[1fr_180px_auto]">
            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari nama produk..."
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
            <select name="status"
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua Status</option>
                <option value="Active" @selected(($filters['status'] ?? '') === 'Active')>Active</option>
                <option value="Inactive" @selected(($filters['status'] ?? '') === 'Inactive')>Inactive</option>
            </select>
            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Filter</button>
                <a href="{{ route('admin.products.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Reset</a>
            </div>
        </form>

        @if ($errors->createProduct->any() || $errors->updateProduct->any())
            <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                <p class="font-semibold">Terdapat input yang belum valid.</p>
                @foreach ($errors->createProduct->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                @foreach ($errors->updateProduct->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Nama Produk</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Dibuat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($products as $product)
                        <tr class="cursor-pointer transition hover:bg-slate-800/40"
                            @click="openManage({ id: {{ $product->id }}, name: @js($product->name), status: @js($product->status) })">
                            <td class="px-4 py-4 font-semibold text-white">{{ $product->name }}</td>
                            <td class="px-4 py-4">
                                <span
                                    class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $product->status === 'Active' ? 'bg-emerald-500/20 text-emerald-200' : 'bg-slate-600/40 text-slate-200' }}">{{ $product->status }}</span>
                            </td>
                            <td class="px-4 py-4">{{ $product->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-slate-400">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="mt-3 text-xs text-slate-400">Klik baris produk untuk membuka modal kelola.</p>

        <div class="mt-5">{{ $products->links() }}</div>

        <div x-show="createOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/60"
            @click="createOpen = false">
        </div>
        <div x-show="createOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl border border-slate-700 bg-[#0b1222] p-6 shadow-2xl shadow-black/50"
                @click.stop>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-white">Tambah Produk</h2>
                    <button type="button" class="text-slate-400 hover:text-white"
                        @click="createOpen = false">Close</button>
                </div>
                <form method="POST" action="{{ route('admin.products.store') }}" class="grid gap-4">
                    @csrf
                    <div><label class="mb-2 block text-sm text-slate-200">Nama Produk</label><input type="text"
                            name="name" value="{{ old('name') }}"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                            required></div>
                    <div><label class="mb-2 block text-sm text-slate-200">Status</label><select name="status"
                            class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                            <option value="Active" @selected(old('status', 'Active') === 'Active')>Active</option>
                            <option value="Inactive" @selected(old('status') === 'Inactive')>Inactive</option>
                        </select></div>
                    <div><button type="submit"
                            class="w-full rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Simpan
                            Produk</button></div>
                </form>
            </div>
        </div>

        <div x-show="manageOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/60"
            @click="manageOpen = false">
        </div>
        <div x-show="manageOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl border border-slate-700 bg-[#0b1222] p-6 shadow-2xl shadow-black/50"
                @click.stop>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-white">Kelola Produk</h2>
                    <button type="button" class="text-slate-400 hover:text-white"
                        @click="manageOpen = false">Close</button>
                </div>

                <div class="space-y-5">
                    <form method="POST" :action="`{{ url('/admin/products') }}/${selected.id}`" class="grid gap-4">
                        @csrf
                        @method('PUT')
                        <div><label class="mb-2 block text-sm text-slate-200">Nama Produk</label><input type="text"
                                name="name" x-model="selected.name"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                                required></div>
                        <div><label class="mb-2 block text-sm text-slate-200">Status</label><select name="status"
                                x-model="selected.status"
                                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select></div>
                        <div><button type="submit"
                                class="w-full rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Update
                                Produk</button></div>
                    </form>

                    <form method="POST" :action="`{{ url('/admin/products') }}/${selected.id}`"
                        data-confirm-message="Yakin ingin menghapus produk ini?" class="border-t border-slate-700 pt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Delete
                            Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
