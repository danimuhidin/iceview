<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard | Iceview')</title>
    <link rel="icon" href="{{ asset('iceview.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Sora:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: radial-gradient(circle at 15% 20%, rgba(0, 240, 255, 0.16), transparent 25%), linear-gradient(145deg, #050b17 0%, #0b1222 40%, #0f172a 100%);
        }

        .brand-font {
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 0.08em;
        }
    </style>

    @stack('head')
</head>

<body class="min-h-screen text-slate-100" x-data="{ sidebarOpen: false }">
    <header class="sticky top-0 z-40 border-b border-slate-700/60 bg-[#060d1d]/90 backdrop-blur-xl">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <button type="button" class="rounded-md border border-slate-600/60 p-2 lg:hidden"
                    @click="sidebarOpen = true" aria-label="Open sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('iceview.png') }}" alt="Iceview" class="h-9 w-auto sm:h-10">
                </a>
            </div>

            <div class="flex items-center gap-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="rounded-md bg-[#00F0FF] px-4 py-2 text-sm font-semibold text-[#0F172A] transition hover:brightness-110">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-6 px-4 py-6 sm:px-6 lg:grid-cols-[260px_1fr] lg:px-8">
        <aside class="hidden rounded-2xl border border-slate-700/60 bg-[#0b1222]/85 p-4 lg:block">
            <p class="brand-font mb-4 px-2 text-lg font-bold text-[#00F0FF]">Navigation</p>
            <nav class="space-y-1 text-sm">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Admin
                        Dashboard</a>
                    <a href="{{ route('admin.site-info.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.site-info.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Manage
                        Info</a>
                    <a href="{{ route('admin.users.index') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Manajemen
                        User</a>
                    <a href="{{ route('account.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('account.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Kelola
                        Akun</a>
                @else
                    <a href="{{ route('user.dashboard') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('user.dashboard') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">User
                        Dashboard</a>
                    <a href="{{ route('account.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('account.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Kelola
                        Akun</a>
                @endif
            </nav>
        </aside>

        <div x-show="sidebarOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/60 lg:hidden"
            @click="sidebarOpen = false"></div>
        <aside x-show="sidebarOpen" x-transition x-cloak
            class="fixed inset-y-0 left-0 z-50 w-72 border-r border-slate-700/60 bg-[#0b1222] p-4 lg:hidden">
            <div class="mb-4 flex items-center justify-between">
                <p class="brand-font text-lg font-bold text-[#00F0FF]">Navigation</p>
                <button type="button" class="rounded-md border border-slate-600/60 p-2" @click="sidebarOpen = false"
                    aria-label="Close sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-1 text-sm">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Admin
                        Dashboard</a>
                    <a href="{{ route('admin.site-info.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.site-info.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Manage
                        Info</a>
                    <a href="{{ route('admin.users.index') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Manajemen
                        User</a>
                    <a href="{{ route('account.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('account.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Kelola
                        Akun</a>
                @else
                    <a href="{{ route('user.dashboard') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('user.dashboard') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">User
                        Dashboard</a>
                    <a href="{{ route('account.edit') }}"
                        class="block rounded-md px-3 py-2 transition hover:bg-slate-800 {{ request()->routeIs('account.*') ? 'bg-slate-800 text-[#00F0FF]' : 'text-slate-300' }}">Kelola
                        Akun</a>
                @endif
            </nav>
        </aside>

        <main>
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-cyan-500/30 bg-cyan-500/10 px-4 py-3 text-sm text-cyan-200">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
