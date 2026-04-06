<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Iceview') . ' | Windows Protection')</title>
    <link rel="icon" href="{{ asset('iceview.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Sora:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        glacier: '#00F0FF',
                        midnight: '#0F172A',
                        slateui: '#334155',
                        frost: '#F8FAFC',
                        silver: '#E2E8F0'
                    }
                }
            }
        };
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --glacier-cyan: #00F0FF;
            --deep-midnight: #0F172A;
            --slate-gray: #334155;
            --frost-white: #F8FAFC;
            --silver-metallic: #E2E8F0;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Sora', sans-serif;
            color: var(--frost-white);
            background:
                radial-gradient(circle at 14% 18%, rgba(0, 240, 255, 0.2), transparent 28%),
                radial-gradient(circle at 82% 4%, rgba(15, 23, 42, 0.4), transparent 36%),
                linear-gradient(145deg, #050b17 0%, #0b1222 40%, #0f172a 100%);
            background-attachment: fixed;
        }

        [x-cloak] {
            display: none !important;
        }

        .brand-font {
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 0.08em;
        }

        .glass-card {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.62) 100%);
            border: 1px solid rgba(148, 163, 184, 0.26);
            backdrop-filter: blur(10px);
            box-shadow: 0 22px 50px rgba(2, 6, 23, 0.55);
        }

        .metal-card {
            background: linear-gradient(160deg, rgba(15, 23, 42, 0.86) 0%, rgba(30, 41, 59, 0.84) 100%);
            border: 1px solid rgba(148, 163, 184, 0.25);
        }

        .reveal {
            opacity: 0;
            transform: translateY(22px);
            animation: revealUp 0.9s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.15s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.45s;
        }

        @keyframes revealUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('head')
</head>

<body>
    @php
        $siteInfo = \App\Models\SiteInfo::query()->first();
        $brandName = $siteInfo?->brand_name ?: 'Iceview';
        $brandImage = $siteInfo?->brand_image ? asset('storage/' . $siteInfo->brand_image) : asset('iceview.png');
        $brandDescription =
            $siteInfo?->description ?:
            'Iceview menghadirkan window film premium berkarakter elegan untuk kenyamanan, performa, dan gaya otomotif modern.';
        $footerText = $siteInfo?->footer_text ?: 'All Right reserved';
    @endphp

    <div x-data="{ mobileMenu: false, showScrollTop: false }" x-init="window.addEventListener('scroll', () => showScrollTop = window.scrollY > 280)" class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-slate-700/50 bg-[#060d1d]/90 text-[#F8FAFC] backdrop-blur-xl">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-4 sm:px-5 lg:px-8">
                <a href="#home" class="inline-flex items-center gap-3">
                    <img src="{{ $brandImage }}" alt="{{ $brandName }}" class="h-9 w-auto sm:h-10">
                    {{-- <span
                        class="brand-font hidden text-2xl font-bold text-[#00F0FF] sm:inline">{{ strtoupper($brandName) }}</span> --}}
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium lg:flex">
                    <a href="{{ route('home') }}" class="transition hover:text-[#00F0FF]">Home</a>
                    <a href="{{ route('about') }}" class="transition hover:text-[#00F0FF]">About Us</a>
                    <a href="{{ route('products') }}" class="transition hover:text-[#00F0FF]">Products</a>
                    <a href="{{ route('dealers') }}" class="transition hover:text-[#00F0FF]">Dealers</a>
                    <a href="{{ route('waranty') }}" class="transition hover:text-[#00F0FF]">Waranty</a>
                </nav>

                <div class="hidden items-center gap-2 lg:flex">
                    @guest
                        <a href="{{ route('login') }}"
                            class="rounded-md border border-slate-500/40 px-4 py-2 text-sm text-[#F8FAFC] transition hover:border-[#00F0FF] hover:text-[#00F0FF]">Login</a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Dashboard</a>
                    @endguest
                </div>

                <button type="button" class="inline-flex rounded-md border border-slate-500/50 p-2 lg:hidden"
                    @click="mobileMenu = !mobileMenu" :aria-expanded="mobileMenu" aria-controls="mobile-menu"
                    aria-label="Toggle Menu">
                    <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenu" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" x-show="mobileMenu" x-transition
                class="border-t border-slate-700/50 bg-[#060d1d] px-5 py-4 lg:hidden">
                <div class="flex flex-col gap-2 text-sm">
                    <a href="{{ route('home') }}" @click="mobileMenu = false"
                        class="rounded px-2 py-2 hover:bg-slate-800">Home</a>
                    <a href="{{ route('about') }}" @click="mobileMenu = false"
                        class="rounded px-2 py-2 hover:bg-slate-800">About
                        US</a>
                    <a href="{{ route('products') }}" @click="mobileMenu = false"
                        class="rounded px-2 py-2 hover:bg-slate-800">Products</a>
                    <a href="{{ route('dealers') }}" @click="mobileMenu = false"
                        class="rounded px-2 py-2 hover:bg-slate-800">Dealers</a>
                    <a href="{{ route('waranty') }}" @click="mobileMenu = false"
                        class="rounded px-2 py-2 hover:bg-slate-800">Waranty</a>

                    <div class="mt-2 flex gap-2 border-t border-slate-700/50 pt-3">
                        @guest
                            <a href="{{ route('login') }}"
                                class="rounded-md border border-slate-500/40 px-4 py-2 text-sm">Login</a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A]">Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('main')
        </main>

        <footer class="border-t border-slate-700/60 bg-[#040912] px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <img src="{{ $brandImage }}" alt="{{ $brandName }}" class="mb-4 h-12 w-auto">
                    <p class="text-sm leading-relaxed text-slate-300">
                        {{ $brandDescription }}
                    </p>
                </div>

                <div>
                    <h3 class="brand-font mb-4 text-xl font-bold text-[#00F0FF]">Info Contact</h3>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li>
                            Telp:
                            @if ($siteInfo?->phone)
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $siteInfo->phone) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="font-semibold hover:text-[#00F0FF]">{{ $siteInfo->phone }}</a>
                            @else
                                -
                            @endif
                        </li>
                        <li>
                            Email:
                            @if ($siteInfo?->email)
                                <a href="mailto:{{ $siteInfo->email }}"
                                    class="font-semibold hover:text-[#00F0FF]">{{ $siteInfo->email }}</a>
                            @else
                                -
                            @endif
                        </li>
                        <li>
                            Alamat:
                            @if ($siteInfo?->link_maps)
                                <a href="{{ $siteInfo->link_maps }}" target="_blank" rel="noopener noreferrer"
                                    class="font-semibold hover:text-[#00F0FF]">{{ $siteInfo?->address ?: '-' }}</a>
                            @else
                                -
                            @endif
                        </li>
                        <li>Jam Operasional: {{ $siteInfo?->office_hour ?: '-' }}</li>
                    </ul>
                </div>

                <div>
                    <h3 class="brand-font mb-4 text-xl font-bold text-[#00F0FF]">Navigate</h3>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="transition hover:text-[#00F0FF]">Home</a></li>
                        <li><a href="{{ route('about') }}" class="transition hover:text-[#00F0FF]">About Us</a></li>
                        <li><a href="{{ route('products') }}" class="transition hover:text-[#00F0FF]">Products</a>
                        </li>
                        <li><a href="{{ route('dealers') }}" class="transition hover:text-[#00F0FF]">Dealers</a></li>
                        <li><a href="{{ route('waranty') }}" class="transition hover:text-[#00F0FF]">Waranty</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="brand-font mb-4 text-xl font-bold text-[#00F0FF]">Social Media</h3>
                    <div class="flex items-center gap-3">
                        <a href="{{ $siteInfo?->instagram_link ?: '#' }}" aria-label="Instagram" target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-slate-500/50 p-2 text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5a4.25 4.25 0 0 0 4.25 4.25h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5a4.25 4.25 0 0 0-4.25-4.25h-8.5Zm8.88 2.37a1.12 1.12 0 1 1 0 2.24 1.12 1.12 0 0 1 0-2.24ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5Z" />
                            </svg>
                        </a>
                        <a href="{{ $siteInfo?->facebook_link ?: '#' }}" aria-label="Facebook" target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-slate-500/50 p-2 text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M13.5 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.6 1.7-1.6h1.5V3.8c-.3 0-1.2-.1-2.2-.1-2.2 0-3.8 1.3-3.8 3.9V10H8v3h2.7v8h2.8Z" />
                            </svg>
                        </a>
                        <a href="{{ $siteInfo?->youtube_link ?: '#' }}" aria-label="YouTube" target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-slate-500/50 p-2 text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M21.6 7.2a2.9 2.9 0 0 0-2-2C17.8 4.7 12 4.7 12 4.7s-5.8 0-7.6.5a2.9 2.9 0 0 0-2 2A30 30 0 0 0 2 12a30 30 0 0 0 .4 4.8 2.9 2.9 0 0 0 2 2c1.8.5 7.6.5 7.6.5s5.8 0 7.6-.5a2.9 2.9 0 0 0 2-2A30 30 0 0 0 22 12a30 30 0 0 0-.4-4.8ZM10 15.3V8.7l5.8 3.3L10 15.3Z" />
                            </svg>
                        </a>
                        <a href="{{ $siteInfo?->tiktok_link ?: '#' }}" aria-label="TikTok" target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-slate-500/50 p-2 text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M15.74 3c.27 1.53 1.17 2.96 2.46 3.93.95.71 2.1 1.07 3.3 1.07v3.14a8.29 8.29 0 0 1-4.72-1.47v6.35c0 3.8-3.08 6.88-6.88 6.88S3 19.82 3 16.02c0-3.8 3.08-6.88 6.88-6.88.23 0 .46.01.68.03v3.2a3.7 3.7 0 0 0-.68-.07 3.72 3.72 0 1 0 3.72 3.72V3h2.14Z" />
                            </svg>
                        </a>
                        <a href="{{ $siteInfo?->marketplace_link ?: '#' }}" aria-label="Marketplace" target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-slate-500/50 p-2 text-slate-200 transition hover:border-[#00F0FF] hover:text-[#00F0FF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M5 4a2 2 0 0 0-2 2v1h18V6a2 2 0 0 0-2-2H5Zm16 5H3v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9ZM8 12h8a1 1 0 1 1 0 2H8a1 1 0 1 1 0-2Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="mx-auto mt-8 grid max-w-7xl gap-3 text-sm text-slate-300 sm:grid-cols-3">
                <details class="rounded-md border border-slate-700/60 bg-[#0a1324] p-3">
                    <summary class="cursor-pointer font-semibold text-slate-200">Syarat & Ketentuan</summary>
                    <div class="prose prose-invert mt-2 max-w-none text-sm">{!! $siteInfo?->terms_conditions ?: '<p>Belum tersedia.</p>' !!}</div>
                </details>
                <details class="rounded-md border border-slate-700/60 bg-[#0a1324] p-3">
                    <summary class="cursor-pointer font-semibold text-slate-200">Kebijakan Privasi</summary>
                    <div class="prose prose-invert mt-2 max-w-none text-sm">{!! $siteInfo?->privacy_policy ?: '<p>Belum tersedia.</p>' !!}</div>
                </details>
                <details class="rounded-md border border-slate-700/60 bg-[#0a1324] p-3">
                    <summary class="cursor-pointer font-semibold text-slate-200">Ketentuan Dealer</summary>
                    <div class="prose prose-invert mt-2 max-w-none text-sm">{!! $siteInfo?->dealer_terms ?: '<p>Belum tersedia.</p>' !!}</div>
                </details>
            </div> --}}

            <div class="mx-auto mt-10 max-w-7xl border-t border-slate-800 pt-6 text-center text-xs text-slate-400">
                {{ $footerText }}
            </div>
        </footer>

        <button x-show="showScrollTop" x-transition x-cloak @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            type="button" aria-label="Scroll to top"
            class="fixed bottom-5 right-5 z-40 rounded-full bg-[#00F0FF] p-3 text-[#0F172A] shadow-lg shadow-cyan-400/30 transition hover:scale-105 hover:brightness-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 0 1 .7.3l5 5a1 1 0 1 1-1.4 1.4L11 6.4V16a1 1 0 1 1-2 0V6.4L5.7 9.7a1 1 0 0 1-1.4-1.4l5-5A1 1 0 0 1 10 3Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    @stack('scripts')
</body>

</html>
