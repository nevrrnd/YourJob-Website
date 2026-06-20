<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'YourJob') }}</title>
        <link rel="icon" type="image/png" href="{{ site_logo_url() }}">
        <link rel="apple-touch-icon" href="{{ site_logo_url() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" media="print" onload="this.media='all'">
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap">
        </noscript>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-950 antialiased">
        <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-[#faf8ff] px-4 py-10">
            <div class="absolute left-0 top-0 h-[520px] w-[520px] -translate-x-1/3 -translate-y-1/3 rounded-full bg-blue-200/60 blur-3xl"></div>
            <div class="absolute right-0 top-0 h-[520px] w-[520px] -translate-y-1/4 translate-x-1/4 rounded-full bg-violet-accent/25 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/2 h-[420px] w-[420px] -translate-x-1/2 translate-y-1/3 rounded-full bg-emerald-100/70 blur-3xl"></div>

            <div class="relative w-full sm:max-w-md">
                <a href="{{ route('home') }}" class="mb-6 flex items-center justify-center gap-2 text-2xl font-extrabold text-blue-700">
                    <img src="{{ site_logo_url() }}" alt="YourJob" class="h-9 w-9 object-contain">
                    YourJob
                </a>

                <div class="rounded-3xl border border-white/50 bg-white/70 px-7 py-8 shadow-2xl shadow-blue-950/10 backdrop-blur-xl">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs font-semibold text-slate-500">&copy; {{ date('Y') }} YourJob. Built for high-growth teams.</p>
            </div>
        </div>
    </body>
</html>
