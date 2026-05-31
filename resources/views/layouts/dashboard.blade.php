<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - YourJob</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-ink-700">
@php
    $role = auth()->user()->role;
    $nav = match ($role) {
        'admin' => [
            ['admin.dashboard', 'Dashboard', []],
            ['admin.users', 'Pengguna', []],
            ['admin.companies', 'Perusahaan', []],
            ['admin.jobs', 'Lowongan', []],
            ['admin.categories.index', 'Kategori', []],
        ],
        'employer' => [
            ['employer.dashboard', 'Dashboard', []],
            ['employer.lowongan.create', 'Posting Lowongan', []],
            ['employer.profile', 'Profil Perusahaan', []],
        ],
        default => [
            ['seeker.dashboard', 'Dashboard', []],
            ['seeker.applications', 'Riwayat Lamaran', []],
            ['seeker.saved', 'Tersimpan', []],
            ['seeker.profile', 'Profil Saya', []],
        ],
    };
@endphp

<div x-data="{ sidebar: false }" class="min-h-screen flex">
    <aside class="fixed inset-y-0 left-0 z-40 w-72 bg-[#0b1c2c] text-[#b9d0e3] transform transition-transform duration-200 lg:translate-x-0 lg:static lg:inset-0"
           :class="sidebar ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-20 flex items-center px-6 border-b border-white/10">
            <a href="{{ route('home') }}" class="flex items-center text-lg">
                <x-app-logo :size="36" invert />
            </a>
        </div>
        <nav class="p-4 space-y-1">
            <p class="px-3 pt-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-white/45">Menu</p>
            @foreach ($nav as [$routeName, $label, $params])
                @php $isActive = request()->routeIs($routeName); @endphp
                <a href="{{ route($routeName, $params) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition
                          {{ $isActive ? 'bg-white text-[#0b1c2c] shadow-soft' : 'text-[#b9d0e3] hover:bg-white/10 hover:text-white' }}">
                    <span class="w-2 h-2 rounded-full {{ $isActive ? 'bg-[#2c7da0]' : 'bg-white/25' }}"></span>
                    <span>{{ $label }}</span>
                </a>
            @endforeach
            <div class="pt-4 mt-4 border-t border-white/10 space-y-1">
                <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold text-[#b9d0e3] hover:bg-white/10 hover:text-white transition">
                    <span class="w-2 h-2 rounded-full bg-white/25"></span> Cari Lowongan
                </a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold text-red-200 hover:bg-red-500/15 transition">
                        <span class="w-2 h-2 rounded-full bg-red-300"></span> Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 bg-ink-900/30 z-30 lg:hidden"></div>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="sticky top-0 z-20 min-h-20 glass flex items-center justify-between px-4 sm:px-6">
            <div class="flex items-center gap-3">
                <button @click="sidebar = !sidebar" class="lg:hidden p-2 rounded-xl text-ink-500 hover:bg-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-[#155e75]">{{ ucfirst($role) }}</p>
                    <h1 class="text-lg font-extrabold premium-heading">{{ $title ?? 'Dashboard' }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="hidden sm:inline btn-ghost btn-sm">Lihat situs</a>
                <div class="flex items-center gap-2 pl-3 border-l border-ink-200">
                    <x-user-avatar />
                    <span class="hidden sm:block text-sm font-bold text-ink-700">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        @include('partials.flash')

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="animate-fade-in max-w-6xl mx-auto">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
