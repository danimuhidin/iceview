<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login | Iceview')</title>
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
        body {
            font-family: 'Sora', sans-serif;
            background: radial-gradient(circle at 14% 18%, rgba(0, 240, 255, 0.2), transparent 28%), linear-gradient(145deg, #050b17 0%, #0b1222 40%, #0f172a 100%);
        }

        .brand-font {
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 0.08em;
        }
    </style>
</head>

<body class="text-slate-100">
    <div class="min-h-screen flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
        @yield('content')
    </div>
</body>

</html>
