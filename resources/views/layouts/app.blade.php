<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'YourJob') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex flex-col" x-data="{ authModal: null }">
    <nav x-data="{ open: false }" class="sticky top-0 z-40 glass">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between min-h-20">
                <div class="flex items-center gap-10">
                    <a href="{{ route('home') }}" class="flex items-center text-lg">
                        <x-app-logo :size="32" />
                    </a>
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-ink-700 hover:text-[#2c7da0] transition">Beranda</a>
                        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-ink-700 hover:text-[#2c7da0] transition">Lowongan</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-ink-700 hover:text-[#2c7da0] transition">Dashboard</a>
                        @endauth
                    </div>
                </div>

                <div class="hidden sm:flex items-center gap-2">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 pl-1.5 pr-2.5 py-1.5 rounded-lg hover:bg-ink-50 transition">
                                    <x-user-avatar />
                                    <span class="text-sm font-medium text-ink-700">{{ Str::limit(Auth::user()->name, 14) }}</span>
                                    <svg class="fill-current h-4 w-4 text-ink-400" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-ink-100">
                                    <p class="text-sm font-semibold text-ink-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-ink-400 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">Pengaturan Akun</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Keluar</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <button type="button" @click="authModal = 'login'" class="btn-ghost btn-sm !px-5 !py-2">Masuk</button>
                        <button type="button" @click="authModal = 'register'" class="btn-primary btn-sm !px-4 !py-2">Daftar Gratis</button>
                    @endauth
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="p-2 rounded-md text-ink-500 hover:bg-ink-100">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </div>
        </div>
        <div x-show="open" x-cloak class="sm:hidden border-t border-ink-200 bg-white px-4 py-3 space-y-1">
            <a href="{{ route('jobs.index') }}" class="block px-3 py-2 rounded-md text-sm text-ink-700 hover:bg-ink-50">Lowongan</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-sm text-ink-700 hover:bg-ink-50">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-sm text-red-600 hover:bg-red-50">Keluar</button>
                </form>
            @else
                <button type="button" @click="authModal = 'login'; open = false" class="block w-full text-left px-3 py-2 rounded-md text-sm text-ink-700 hover:bg-ink-50">Masuk</button>
                <button type="button" @click="authModal = 'register'; open = false" class="block w-full text-left px-3 py-2 rounded-md text-sm text-brand-600 font-semibold hover:bg-brand-50">Daftar Gratis</button>
            @endauth
        </div>
    </nav>

    @include('partials.flash')

    @guest
        <div
            x-show="authModal"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="authModal = null"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/45 px-4 py-8 backdrop-blur-sm"
        >
            <div class="absolute inset-0" @click="authModal = null"></div>
            <div
                x-show="authModal"
                x-transition
                class="relative w-full max-w-md rounded-[2rem] bg-white/95 p-7 shadow-lift border border-white/80 max-h-[90vh] overflow-y-auto"
            >
                <button type="button" @click="authModal = null" class="absolute right-5 top-4 text-2xl leading-none text-ink-400 hover:text-ink-700">&times;</button>

                <div class="mb-6 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#2c7da0]/10 text-[#155e75] mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586l6.257-6.257A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold premium-heading" x-text="authModal === 'login' ? 'Masuk Akun' : 'Daftar Akun Baru'"></h2>
                    <p class="text-sm text-ink-500 mt-2" x-text="authModal === 'login' ? 'Masuk untuk melanjutkan ke YourJob' : 'Gratis, hanya butuh satu menit'"></p>
                </div>

                <div class="mb-5 grid grid-cols-2 rounded-full bg-ink-100 p-1 text-sm font-bold">
                    <button type="button" @click="authModal = 'login'" class="rounded-full px-4 py-2 transition" :class="authModal === 'login' ? 'bg-white text-[#1e4a6e] shadow-xs' : 'text-ink-500'">Masuk</button>
                    <button type="button" @click="authModal = 'register'" class="rounded-full px-4 py-2 transition" :class="authModal === 'register' ? 'bg-white text-[#1e4a6e] shadow-xs' : 'text-ink-500'">Daftar</button>
                </div>

                <form x-show="authModal === 'login'" method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 rounded-full border border-ink-200 bg-white px-5 py-3 text-sm font-bold text-ink-700 shadow-xs transition hover:border-[#2c7da0] hover:bg-[#f0f9ff]">
                        <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
                        Masuk dengan Google
                    </a>
                    <div class="flex items-center gap-3 text-xs font-semibold text-ink-400">
                        <span class="h-px flex-1 bg-ink-200"></span>
                        atau email
                        <span class="h-px flex-1 bg-ink-200"></span>
                    </div>
                    <div>
                        <label for="modal_login_email" class="block text-sm font-bold text-ink-700 mb-1.5">Email</label>
                        <input id="modal_login_email" type="email" name="email" required autocomplete="username" placeholder="Email" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                    </div>
                    <div>
                        <label for="modal_login_password" class="block text-sm font-bold text-ink-700 mb-1.5">Kata Sandi</label>
                        <input id="modal_login_password" type="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="rounded border-ink-300 text-[#2c7da0] shadow-sm focus:ring-[#2c7da0]/30" name="remember">
                            <span class="ms-2 text-sm text-ink-600">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-semibold text-[#1e4a6e] hover:text-[#2c7da0]" href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn-primary w-full py-3">Masuk</button>
                    <p class="text-center text-sm text-ink-500">Belum punya akun? <button type="button" @click="authModal = 'register'" class="font-bold text-[#1e4a6e] hover:text-[#2c7da0]">Daftar gratis</button></p>
                </form>

                <form x-show="authModal === 'register'" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 rounded-full border border-ink-200 bg-white px-5 py-3 text-sm font-bold text-ink-700 shadow-xs transition hover:border-[#2c7da0] hover:bg-[#f0f9ff]">
                        <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
                        Daftar dengan Google
                    </a>
                    <div class="flex items-center gap-3 text-xs font-semibold text-ink-400">
                        <span class="h-px flex-1 bg-ink-200"></span>
                        atau daftar manual
                        <span class="h-px flex-1 bg-ink-200"></span>
                    </div>
                    <div>
                        <label for="modal_name" class="block text-sm font-bold text-ink-700 mb-1.5">Nama Lengkap</label>
                        <input id="modal_name" type="text" name="name" required autocomplete="name" placeholder="Nama kamu" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                    </div>
                    <div>
                        <label for="modal_register_email" class="block text-sm font-bold text-ink-700 mb-1.5">Email</label>
                        <input id="modal_register_email" type="email" name="email" required autocomplete="username" placeholder="Email" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="modal_register_password" class="block text-sm font-bold text-ink-700 mb-1.5">Password</label>
                            <input id="modal_register_password" type="password" name="password" required autocomplete="new-password" placeholder="Password" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                        </div>
                        <div>
                            <label for="modal_password_confirmation" class="block text-sm font-bold text-ink-700 mb-1.5">Konfirmasi</label>
                            <input id="modal_password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full py-3">Daftar Sekarang</button>
                    <p class="text-center text-sm text-ink-500">Sudah punya akun? <button type="button" @click="authModal = 'login'" class="font-bold text-[#1e4a6e] hover:text-[#2c7da0]">Masuk di sini</button></p>
                </form>
            </div>
        </div>
    @endguest

    @isset($header)
        <header class="bg-white border-b border-ink-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{{ $header }}</div>
        </header>
    @endisset

    <main class="flex-1">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="mt-20 bg-[#0b1c2c] text-[#b9d0e3] rounded-t-[3rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center text-lg">
                        <x-app-logo :size="32" />
                    </a>
                    <p class="text-sm mt-3 leading-relaxed opacity-80">Platform lowongan kerja terpercaya untuk menghubungkan talenta dengan perusahaan terbaik.</p>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-white">Pencari Kerja</h4>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('jobs.index') }}" class="hover:text-brand-600">Cari Lowongan</a></li>
                        <li><button type="button" @click="authModal = 'register'" class="hover:text-brand-600">Buat Akun</button></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-white">Perusahaan</h4>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><button type="button" @click="authModal = 'register'" class="hover:text-brand-600">Pasang Lowongan</button></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-white">Bantuan</h4>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><span class="opacity-80">Tentang Kami</span></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-[#1e3347] text-sm opacity-75">
                &copy; {{ date('Y') }} YourJob. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>
