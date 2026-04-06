@extends('layouts.panel')

@section('title', 'Manage Info | Iceview')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-6 sm:p-8">
        <div class="mb-6">
            <p class="brand-font mb-1 text-sm uppercase tracking-wider text-[#00F0FF]">Admin Feature</p>
            <h1 class="text-2xl font-bold text-white">Manage Info</h1>
            <p class="mt-1 text-sm text-slate-300">Atur identitas brand, kontak, sosial media, dan konten legal website.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                <p class="font-semibold">Terdapat input yang belum valid.</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.site-info.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Brand Image</label>
                    <input type="file" name="brand_image" accept=".jpg,.jpeg,.png,.webp"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 file:mr-3 file:rounded-md file:border-0 file:bg-[#00F0FF] file:px-3 file:py-1 file:text-xs file:font-semibold file:text-[#0F172A]">
                    @if ($siteInfo->brand_image)
                        <img src="{{ asset('storage/' . $siteInfo->brand_image) }}" alt="Brand Image"
                            class="mt-3 h-14 w-auto rounded-md border border-slate-700/60">
                    @endif
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Brand Name</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name', $siteInfo->brand_name) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-200">Description</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">{{ old('description', $siteInfo->description) }}</textarea>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Footer Text (All Rights Reserved)</label>
                    <input type="text" name="footer_text" value="{{ old('footer_text', $siteInfo->footer_text) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                        required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Office Hour</label>
                    <input type="text" name="office_hour" value="{{ old('office_hour', $siteInfo->office_hour) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-200">Alamat</label>
                <textarea name="address" rows="2"
                    class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">{{ old('address', $siteInfo->address) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-200">Link Maps</label>
                <input type="url" name="link_maps" value="{{ old('link_maps', $siteInfo->link_maps) }}"
                    class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]"
                    placeholder="https://maps.google.com/...">
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Email</label>
                    <input type="email" name="email" value="{{ old('email', $siteInfo->email) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">No Telp</label>
                    <input type="text" name="phone" value="{{ old('phone', $siteInfo->phone) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Link Instagram</label>
                    <input type="url" name="instagram_link"
                        value="{{ old('instagram_link', $siteInfo->instagram_link) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Link TikTok</label>
                    <input type="url" name="tiktok_link" value="{{ old('tiktok_link', $siteInfo->tiktok_link) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Link Facebook</label>
                    <input type="url" name="facebook_link" value="{{ old('facebook_link', $siteInfo->facebook_link) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Link YouTube</label>
                    <input type="url" name="youtube_link" value="{{ old('youtube_link', $siteInfo->youtube_link) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Link Marketplace</label>
                    <input type="url" name="marketplace_link"
                        value="{{ old('marketplace_link', $siteInfo->marketplace_link) }}"
                        class="w-full rounded-md border border-slate-500/40 bg-[#111d33] px-3 py-2 text-sm text-slate-100 outline-none focus:border-[#00F0FF]">
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Syarat & Ketentuan</label>
                    <textarea name="terms_conditions" class="summernote">{{ old('terms_conditions', $siteInfo->terms_conditions) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Kebijakan Privasi</label>
                    <textarea name="privacy_policy" class="summernote">{{ old('privacy_policy', $siteInfo->privacy_policy) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Ketentuan Dealer</label>
                    <textarea name="dealer_terms" class="summernote">{{ old('dealer_terms', $siteInfo->dealer_terms) }}</textarea>
                </div>
            </div>

            <button type="submit"
                class="rounded-md bg-[#00F0FF] px-5 py-2.5 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">
                Simpan Perubahan
            </button>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
                height: 220,
                placeholder: 'Tuliskan konten di sini...'
            });
        });
    </script>
@endpush
