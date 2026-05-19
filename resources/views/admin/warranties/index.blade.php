@extends('layouts.panel')

@section('title', 'Admin Garansi | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">Daftar Garansi</h1>
                <p class="mt-1 text-sm text-slate-300">Pantau semua garansi yang masuk dari seluruh user.</p>
            </div>
            <a href="{{ route('admin.claims.index') }}"
                class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Lihat
                Pending Claim</a>
        </div>

        <form method="GET" action="{{ route('admin.warranties.index') }}"
            class="mb-5 grid gap-3 rounded-xl border border-slate-700/60 bg-[#0f1a2f] p-4 md:grid-cols-[1fr_auto]">
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari customer, kode, nomor mesin, pol..."
                class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Filter</button>
                <a href="{{ route('admin.warranties.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Kode Garansi</th>
                        <th class="px-4 py-3 text-left font-semibold">User</th>
                        <th class="px-4 py-3 text-left font-semibold">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold">No Rangka</th>
                        <th class="px-4 py-3 text-left font-semibold">Nopol</th>
                        <th class="px-4 py-3 text-left font-semibold">Item</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($warranties as $warranty)
                        <tr>
                            <td class="px-4 py-4 font-semibold text-white">{{ $warranty->warranty_code }}</td>
                            <td class="px-4 py-4">{{ $warranty->dealer?->name ?: '-' }}</td>
                            <td class="px-4 py-4">{{ $warranty->customer_name }}<div class="text-xs text-slate-400">
                                    {{ $warranty->customer_email }}</div>
                            </td>
                            <td class="px-4 py-4">{{ $warranty->engine_number }}</td>
                            <td class="px-4 py-4">{{ $warranty->license_plate_number ?: '-' }}</td>
                            <td class="px-4 py-4">{{ $warranty->items_count }}</td>
                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.warranties.show', $warranty) }}"
                                        class="rounded-md border border-slate-500/50 px-3 py-1.5 text-xs text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Detail</a>
                                    <a href="{{ route('admin.warranties.edit', $warranty) }}"
                                        class="rounded-md border border-slate-500/50 px-3 py-1.5 text-xs text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Edit</a>
                                    @if (in_array(auth()->id(), explode(',', env('ALLOWED_WARRANTY_DELETERS', ''))))
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.warranties.destroy', $warranty->id) }}')"
                                            class="rounded-md border border-red-500/50 px-3 py-1.5 text-xs text-red-500 transition hover:bg-red-500 hover:text-white">Hapus</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada data garansi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $warranties->links() }}</div>
    </section>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-[#060b14]/80 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <!-- Modal Panel -->
        <div
            class="relative w-full max-w-sm transform overflow-hidden rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-6 text-left align-middle shadow-xl transition-all shadow-[#00F0FF]/10">
            <h3 class="text-lg font-bold leading-6 text-white">Konfirmasi Hapus</h3>
            <div class="mt-2">
                <p class="text-sm text-slate-300">
                    Apakah Anda yakin ingin menghapus seluruh bundling garansi ini? Tindakan ini juga akan menghapus seluruh
                    item garansi di bawahnya.
                </p>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="rounded-md border border-slate-600 px-4 py-2 text-sm font-medium text-slate-300 transition hover:bg-slate-700/50 focus:outline-none">
                    Batal
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-md bg-red-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-600 focus:outline-none">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(url) {
            document.getElementById('deleteForm').action = url;

            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.getElementById('deleteForm').action = '';
        }
    </script>
@endsection
