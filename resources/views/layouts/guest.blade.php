<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'YourJob') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink-700 antialiased">
        <div class="relative min-h-screen flex flex-col justify-center items-center px-4 py-10 overflow-hidden" style="background: linear-gradient(145deg, #f8fafd 0%, #eff3fa 100%);">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2c7da0]/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-[#48b5d0]/10 blur-3xl"></div>

            <div class="relative w-full sm:max-w-md animate-fade-up">
                <a href="{{ route('home') }}" class="flex items-center justify-center text-xl mb-6">
                    <x-app-logo :size="42" />
                </a>

                <div class="bg-white/95 backdrop-blur-xl shadow-lift rounded-[2rem] border border-white/80 px-7 py-8">
                    {{ $slot }}
                </div>

                <p class="text-center text-xs text-ink-400 mt-6">&copy; {{ date('Y') }} YourJob. Platform lowongan kerja terpercaya.</p>
            </div>
        </div>
    </body>
</html>
