<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __($title ?? 'Dashboard') }} - YourJob</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">
@php
    $user = auth()->user();
    $role = $user->role;
    $roleLabel = match ($role) {
        'admin' => __('Admin'),
        'employer' => __('Workspace Perekrut'),
        default => __('Workspace Kandidat'),
    };
    $nav = match ($role) {
        'admin' => [
            ['admin.dashboard', 'Dashboard', 'dashboard', []],
            ['admin.users', 'Pengguna', 'group', []],
            ['admin.companies', 'Perusahaan', 'domain', []],
            ['admin.jobs', 'Lowongan', 'work', []],
            ['admin.categories.index', 'Kategori', 'category', []],
            ['admin.settings', 'Pengaturan', 'tune', []],
        ],
        'employer' => [
            ['employer.dashboard', 'Dashboard', 'dashboard', []],
            ['employer.lowongan.create', 'Posting Lowongan', 'add_circle', []],
            ['employer.profile', 'Profil Perusahaan', 'domain', []],
        ],
        default => [
            ['seeker.dashboard', 'Dashboard', 'dashboard', []],
            ['seeker.applications', 'Riwayat Lamaran', 'assignment', []],
            ['seeker.saved', 'Lowongan Tersimpan', 'bookmark', []],
            ['seeker.profile', 'Profil Saya', 'person', []],
        ],
    };
    $nav[] = ['preferences', 'Preferensi', 'tune', []];
@endphp

<div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
    <aside class="fixed inset-y-0 left-0 z-50 hidden w-[280px] border-r border-slate-200 bg-white lg:flex lg:flex-col">
        <div class="flex h-20 items-center px-7">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-extrabold tracking-tight text-slate-950">
                <img src="{{ asset('logo.png') }}" alt="YourJob" class="h-8 w-8 object-contain">
                YourJob
            </a>
        </div>

        <div class="px-4">
            <div class="rounded-3xl bg-slate-950 p-4 text-white">
                <div class="flex items-center gap-3">
                    <x-user-avatar class="h-10 w-10" />
                    <div class="min-w-0">
                        <div class="truncate text-sm font-extrabold">{{ $user->name }}</div>
                        <div class="truncate text-xs font-semibold text-slate-400">{{ $roleLabel }}</div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="mt-5 flex-1 space-y-1 px-4">
            @foreach ($nav as [$routeName, $label, $icon, $params])
                @php $isActive = request()->routeIs($routeName); @endphp
                <a href="{{ route($routeName, $params) }}"
                   class="flex min-h-11 items-center gap-3 rounded-2xl px-4 text-sm font-semibold transition {{ $isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $icon }}</span>
                    <span class="truncate">{{ __($label) }}</span>
                </a>
            @endforeach
        </nav>

        <div class="space-y-3 border-t border-slate-200 p-4">
            <a href="{{ route('jobs.index') }}" class="flex min-h-11 items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700">
                <span class="material-symbols-outlined text-[18px]">search</span>
                {{ __('Cari Lowongan') }}
            </a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="flex min-h-11 w-full items-center justify-center rounded-full border border-red-200 bg-red-50 px-4 text-sm font-semibold text-red-600 transition hover:bg-red-100">{{ __('Keluar') }}</button>
            </form>
        </div>
    </aside>

    <div class="lg:col-start-2">
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-slate-50/95 backdrop-blur">
            <div class="flex min-h-16 items-center justify-between gap-4 px-5 sm:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-extrabold text-slate-950 lg:hidden">
                    <img src="{{ asset('logo.png') }}" alt="YourJob" class="h-7 w-7 object-contain">
                    YourJob
                </a>
                <div class="hidden text-sm font-semibold text-slate-500 lg:block">{{ __($title ?? 'Dashboard') }}</div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hidden rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:text-blue-600 sm:inline-flex">{{ __('Lihat Situs') }}</a>
                    <a href="{{ route('jobs.index') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:text-blue-600 lg:hidden">{{ __('Lowongan') }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="lg:hidden">@csrf
                        <button type="submit" class="rounded-full border border-red-200 bg-white px-4 py-2 text-sm font-semibold text-red-600">{{ __('Keluar') }}</button>
                    </form>
                </div>
            </div>
            <div class="flex gap-2 overflow-x-auto px-5 pb-4 sm:px-8 lg:hidden">
                @foreach ($nav as [$routeName, $label, $icon, $params])
                    @php $isActive = request()->routeIs($routeName); @endphp
                    <a href="{{ route($routeName, $params) }}"
                       class="inline-flex min-h-10 shrink-0 items-center gap-2 rounded-full px-3 text-xs font-semibold transition {{ $isActive ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 ring-1 ring-slate-200' }}">
                        <span class="material-symbols-outlined text-[17px]">{{ $icon }}</span>
                        {{ __($label) }}
                    </a>
                @endforeach
            </div>
        </header>

        @include('partials.flash')

        <main class="px-4 py-5 sm:px-8 sm:py-6 lg:px-10">
        <section class="mb-6 overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200/75 sm:mb-8">
            <div class="relative p-5 sm:p-8">
                <div class="relative flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="mb-3 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-blue-600 sm:text-sm">
                            <span class="material-symbols-outlined text-[18px]">workspace_premium</span>
                            {{ $roleLabel }}
                        </span>
                        <h1 class="text-2xl font-extrabold leading-tight text-slate-950 sm:text-4xl">{{ __($title ?? 'Dashboard') }}</h1>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">{{ __('Kelola aktivitas YourJob dari satu workspace yang fokus dan rapi.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="animate-fade-in">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
        </main>
    </div>
</div>
</body>
</html>
