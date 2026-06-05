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
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#1a1c1e] antialiased">
        <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-slate-950 px-4 py-10">
            <div class="absolute right-0 top-0 h-[520px] w-[520px] -translate-y-1/3 translate-x-1/4 rounded-full bg-[#003ec7]/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-[420px] w-[420px] -translate-x-1/3 translate-y-1/3 rounded-full bg-[#f2b84b]/20 blur-3xl"></div>

            <div class="relative w-full sm:max-w-md">
                <a href="{{ route('home') }}" class="mb-6 flex items-center justify-center gap-2 text-2xl font-extrabold text-white">
                    <img src="{{ site_logo_url() }}" alt="YourJob" class="h-9 w-9 object-contain brightness-0 invert">
                    YourJob
                </a>

                <div class="rounded-2xl border border-white/20 bg-white/95 px-7 py-8 shadow-2xl backdrop-blur">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs text-[#c3c5d9]">&copy; {{ date('Y') }} YourJob. Built for high-growth teams.</p>
            </div>
        </div>
    </body>
</html>
