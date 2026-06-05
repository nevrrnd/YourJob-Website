<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('site_name', 'YourJob') }} - Pemeliharaan</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="grid min-h-screen place-items-center bg-[#150726] px-6 text-center font-sans antialiased">
    <div class="max-w-md">
        <a href="{{ url('/') }}" class="mb-8 inline-flex items-center gap-2 text-2xl font-extrabold text-white">
            <img src="{{ asset('logo.png') }}" alt="YourJob" class="h-8 w-8 object-contain brightness-0 invert">
            YourJob
        </a>
        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-xl bg-[#f2b84b] text-[#150726]">
            <span class="material-symbols-outlined text-3xl">construction</span>
        </div>
        <h1 class="text-3xl font-extrabold text-white">Sedang Pemeliharaan</h1>
        <p class="mt-3 leading-relaxed text-[#e2e2e5]">{{ $message ?? 'Situs sedang dalam pemeliharaan. Silakan kembali beberapa saat lagi.' }}</p>
        <div class="mt-6 flex items-center justify-center gap-3">
            <a href="{{ url('/') }}" class="btn-ghost btn-sm">Muat ulang</a>
            <a href="{{ route('login') }}" class="btn-primary btn-sm">Masuk Admin</a>
        </div>
    </div>
</body>
</html>
