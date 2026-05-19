@extends('layouts.panel')

@section('title', 'Detail Garansi Admin | Ice View Indonesia')

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
                <h1 class="text-2xl font-bold text-white">{{ $warranty->warranty_code }}</h1>
                <p class="mt-1 text-sm text-slate-300">Detail garansi dan histori item kaca.</p>
            </div>
            <div class="flex gap-2">
                @if (in_array(auth()->id(), explode(',', env('ALLOWED_WARRANTY_DELETERS', ''))))
                    <button type="button"
                        onclick="openDeleteModal('{{ route('admin.warranties.destroy', $warranty->id) }}', 'Yakin ingin menghapus seluruh bundling garansi ini beserta itemnya?')"
                        class="rounded-md border border-red-500/50 bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-500 transition hover:bg-red-500 hover:text-white">Hapus
                        Garansi</button>
                @endif
                <a href="{{ route('admin.warranties.edit', $warranty) }}"
                    class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Edit</a>
                <a href="{{ route('admin.warranties.index') }}"
                    class="rounded-md border border-slate-500/50 px-4 py-2 text-sm text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Kembali</a>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">User</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->dealer?->name ?: '-' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Customer</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->customer_name }}</p>
                <p class="text-sm text-slate-400">{{ $warranty->customer_email }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tipe Mobil</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->car_type }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nomor Rangka</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->engine_number }}</p>
            </div>
            <div class="rounded-2xl border border-slate-700/60 bg-[#0f1a2f] p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nomor Polisi</p>
                <p class="mt-2 text-lg font-semibold text-white">{{ $warranty->license_plate_number ?: '-' }}</p>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto rounded-xl border border-slate-700/60">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-[#111d33] text-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Posisi</th>
                        <th class="px-4 py-3 text-left font-semibold">Produk</th>
                        <th class="px-4 py-3 text-left font-semibold">Expired At</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        @if (in_array(auth()->id(), explode(',', env('ALLOWED_WARRANTY_DELETERS', ''))))
                            <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 bg-[#0b1222] text-slate-300">
                    @forelse ($warranty->items as $item)
                        <tr>
                            <td class="px-4 py-4 font-semibold text-white">{{ $item->item_position }}</td>
                            <td class="px-4 py-4">{{ $item->product_name }}</td>
                            <td class="px-4 py-4">{{ $item->expired_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-4"><span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'Active' ? 'bg-emerald-500/20 text-emerald-200' : ($item->status === 'Pending Claim' ? 'bg-amber-500/20 text-amber-200' : 'bg-slate-600/50 text-slate-200') }}">{{ $item->status_label }}</span>
                            </td>
                            @if (in_array(auth()->id(), explode(',', env('ALLOWED_WARRANTY_DELETERS', ''))))
                                <td class="px-4 py-4">
                                    <button type="button"
                                        onclick="openDeleteModal('{{ route('admin.warranties.items.destroy', $item->id) }}', 'Yakin ingin menghapus item garansi ini?')"
                                        class="rounded-md border border-red-500/50 px-3 py-1.5 text-xs text-red-400 transition hover:bg-red-500/10 hover:border-red-500 hover:text-red-300">Hapus</button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-slate-400">Belum ada item garansi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
                <p id="deleteModalMessage" class="text-sm text-slate-300">
                    Apakah Anda yakin ingin menghapus data ini?
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
        function openDeleteModal(url, message = 'Apakah Anda yakin?') {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModalMessage').textContent = message;

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
