<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? setting('site_name', config('app.name', 'YourJob')) }}</title>
    <link rel="icon" type="image/png" href="{{ site_logo_url() }}">
    <link rel="apple-touch-icon" href="{{ site_logo_url() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-slate-50 font-sans text-slate-900 antialiased" x-data="{ authModal: null }">
    <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur">
        <nav class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-extrabold tracking-tight text-slate-950">
                <img src="{{ site_logo_url() }}" alt="YourJob" class="h-8 w-8 object-contain">
                YourJob
            </a>
            <div class="hidden items-center gap-5 text-sm sm:flex">
                <a class="font-semibold {{ request()->routeIs('home') ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600' }}" href="{{ route('home') }}">Home</a>
                <a class="font-semibold {{ request()->routeIs('jobs.*') ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600' }}" href="{{ route('jobs.index') }}">Jobs</a>
                @auth
                    <a class="font-semibold text-slate-600 hover:text-blue-600" href="{{ route('dashboard') }}">Profile</a>
                @else
                    <button type="button" @click="authModal = 'register'" class="font-semibold text-slate-600 hover:text-blue-600">Profile</button>
                @endauth
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 rounded-lg px-2.5 py-1.5 transition hover:bg-[#f3f3f6]">
                                    <x-user-avatar />
                                    <span class="text-sm font-semibold text-[#434656]">{{ Str::limit(Auth::user()->name, 14) }}</span>
                                    <svg class="h-4 w-4 fill-current text-[#737688]" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-ink-100">
                                    <p class="text-sm font-semibold text-ink-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-ink-400 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">Pengaturan Akun</x-dropdown-link>
                                <x-dropdown-link :href="route('preferences')">{{ __('Preferensi') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Keluar') }}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <button type="button" @click="authModal = 'login'" class="text-sm font-semibold text-slate-600 transition hover:text-blue-600">Log In</button>
                        <button type="button" @click="authModal = 'register'" class="rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">Sign Up</button>
                    @endauth
            </div>

            <button @click="open = ! open" class="rounded-md p-2 text-slate-600 hover:bg-slate-100 sm:hidden">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </nav>
        <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-4 sm:hidden">
            <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Home</a>
            <a href="{{ route('jobs.index') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Jobs</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-[#434656] hover:bg-[#f7f8f9]">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="block w-full rounded-md px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50">Keluar</button>
                </form>
            @else
                <button type="button" @click="authModal = 'login'; open = false" class="block w-full rounded-md px-3 py-2 text-left text-sm font-semibold text-[#434656] hover:bg-[#f7f8f9]">Log In</button>
                <button type="button" @click="authModal = 'register'; open = false" class="block w-full rounded-md px-3 py-2 text-left text-sm font-bold text-[#003ec7] hover:bg-[#dde1ff]">Sign Up</button>
            @endauth
        </div>
    </header>

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
                class="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-2xl border border-[#e5e7eb] bg-white p-7 shadow-2xl"
            >
                <button type="button" @click="authModal = null" class="absolute right-5 top-4 text-2xl leading-none text-ink-400 hover:text-ink-700">&times;</button>

                <div class="mb-6 text-center">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#dde1ff] text-[#003ec7]">
                        <span class="material-symbols-outlined">login</span>
                    </div>
                    <h2 class="text-2xl font-extrabold text-[#1a1c1e]" x-text="authModal === 'login' ? 'Masuk Akun' : 'Daftar Akun Baru'"></h2>
                    <p class="mt-2 text-sm text-[#737688]" x-text="authModal === 'login' ? 'Masuk untuk melanjutkan ke YourJob' : 'Gratis, hanya butuh satu menit'"></p>
                </div>

                <div class="mb-5 grid grid-cols-2 rounded-lg bg-[#f3f3f6] p-1 text-sm font-bold">
                    <button type="button" @click="authModal = 'login'" class="rounded-lg px-4 py-2 transition" :class="authModal === 'login' ? 'bg-white text-[#003ec7] shadow-sm' : 'text-[#737688]'">Masuk</button>
                    <button type="button" @click="authModal = 'register'" class="rounded-lg px-4 py-2 transition" :class="authModal === 'register' ? 'bg-white text-[#003ec7] shadow-sm' : 'text-[#737688]'">Daftar</button>
                </div>

                <form x-show="authModal === 'login'" method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border border-[#c3c5d9] bg-white px-5 py-3 text-sm font-bold text-[#434656] shadow-sm transition hover:border-[#003ec7] hover:text-[#003ec7]">
                        <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
                        Masuk dengan Google
                    </a>
                    <div class="flex items-center gap-3 text-xs font-semibold text-ink-400">
                        <span class="h-px flex-1 bg-ink-200"></span>
                        atau email
                        <span class="h-px flex-1 bg-ink-200"></span>
                    </div>
                    <div>
                        <label for="modal_login_email" class="mb-1.5 block text-sm font-bold text-[#434656]">Email</label>
                        <input id="modal_login_email" type="email" name="email" required autocomplete="username" placeholder="Email" class="field">
                    </div>
                    <div>
                        <label for="modal_login_password" class="mb-1.5 block text-sm font-bold text-[#434656]">Kata Sandi</label>
                        <input id="modal_login_password" type="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi" class="field">
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="rounded border-[#c3c5d9] text-[#003ec7] shadow-sm focus:ring-[#003ec7]/30" name="remember">
                            <span class="ms-2 text-sm text-ink-600">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-semibold text-[#003ec7] hover:text-[#002f9c]" href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn-primary w-full py-3">Masuk</button>
                    <p class="text-center text-sm text-[#737688]">Belum punya akun? <button type="button" @click="authModal = 'register'" class="font-bold text-[#003ec7] hover:text-[#002f9c]">Daftar gratis</button></p>
                </form>

                <form x-show="authModal === 'register'" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border border-[#c3c5d9] bg-white px-5 py-3 text-sm font-bold text-[#434656] shadow-sm transition hover:border-[#003ec7] hover:text-[#003ec7]">
                        <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
                        Daftar dengan Google
                    </a>
                    <div class="flex items-center gap-3 text-xs font-semibold text-ink-400">
                        <span class="h-px flex-1 bg-ink-200"></span>
                        atau daftar manual
                        <span class="h-px flex-1 bg-ink-200"></span>
                    </div>
                    <div>
                        <label for="modal_name" class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Lengkap</label>
                        <input id="modal_name" type="text" name="name" required autocomplete="name" placeholder="Nama kamu" class="field">
                    </div>
                    <div>
                        <label for="modal_register_email" class="mb-1.5 block text-sm font-bold text-[#434656]">Email</label>
                        <input id="modal_register_email" type="email" name="email" required autocomplete="username" placeholder="Email" class="field">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="modal_register_password" class="mb-1.5 block text-sm font-bold text-[#434656]">Password</label>
                            <input id="modal_register_password" type="password" name="password" required autocomplete="new-password" placeholder="Password" class="field">
                        </div>
                        <div>
                            <label for="modal_password_confirmation" class="mb-1.5 block text-sm font-bold text-[#434656]">Konfirmasi</label>
                            <input id="modal_password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi" class="field">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full py-3">Daftar Sekarang</button>
                    <p class="text-center text-sm text-[#737688]">Sudah punya akun? <button type="button" @click="authModal = 'login'" class="font-bold text-[#003ec7] hover:text-[#002f9c]">Masuk di sini</button></p>
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

    <footer class="bg-slate-950 py-16 text-white">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-6 px-8 md:grid-cols-4">
            <div>
                <a class="mb-6 flex items-center gap-2 text-2xl font-black leading-8 text-white" href="{{ route('home') }}">
                    <img src="{{ site_logo_url() }}" alt="YourJob" class="h-8 w-8 object-contain brightness-0 invert">
                    YourJob
                </a>
                <p class="mb-6 text-xs font-medium leading-4 text-[#c3c5d9]">{{ setting('footer_text', 'Empowering the next generation of industry leaders through meaningful connections and transparent opportunities.') }}</p>
                    @php
                        $contactEmail = setting('contact_email');
                        $contactPhone = setting('contact_phone');
                        $socials = array_filter([
                            'Facebook' => setting('social_facebook'),
                            'Instagram' => setting('social_instagram'),
                            'LinkedIn' => setting('social_linkedin'),
                        ]);
                    @endphp
                    @if ($contactEmail || $contactPhone)
                        <div class="space-y-1 text-xs font-medium leading-4 text-[#c3c5d9]">
                            @if ($contactEmail)<p>Email: {{ $contactEmail }}</p>@endif
                            @if ($contactPhone)<p>Telepon: {{ $contactPhone }}</p>@endif
                        </div>
                    @endif
                    @if (count($socials))
                        <div class="mt-4 flex gap-3 text-xs font-medium leading-4">
                            @foreach ($socials as $name => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="text-[#c3c5d9] transition hover:text-white">{{ $name }}</a>
                            @endforeach
                        </div>
                    @endif
            </div>
            <div>
                <h4 class="mb-6 text-sm font-semibold leading-5 text-white">Platform</h4>
                <ul class="space-y-4">
                    <li><a class="text-xs font-medium leading-4 text-[#c3c5d9] transition hover:text-white" href="{{ route('jobs.index') }}">Browse Jobs</a></li>
                    <li><a class="text-xs font-medium leading-4 text-[#f2b84b]" href="{{ route('jobs.index') }}">Company Directory</a></li>
                    <li><a class="text-xs font-medium leading-4 text-[#c3c5d9] transition hover:text-white" href="{{ route('jobs.index') }}">Salary Tool</a></li>
                </ul>
            </div>
            <div>
                <h4 class="mb-6 text-sm font-semibold leading-5 text-white">For Employers</h4>
                <ul class="space-y-4">
                    <li><button type="button" @click="authModal = 'register'" class="text-xs font-medium leading-4 text-[#c3c5d9] transition hover:text-white">Hire Talent</button></li>
                    <li><button type="button" @click="authModal = 'register'" class="text-xs font-medium leading-4 text-[#c3c5d9] transition hover:text-white">Post a Job</button></li>
                    <li><button type="button" @click="authModal = 'register'" class="text-xs font-medium leading-4 text-[#c3c5d9] transition hover:text-white">Pricing</button></li>
                </ul>
            </div>
            <div>
                <h4 class="mb-6 text-sm font-semibold leading-5 text-white">Resources</h4>
                <ul class="space-y-4">
                    <li><span class="text-xs font-medium leading-4 text-[#c3c5d9]">About Us</span></li>
                    <li><span class="text-xs font-medium leading-4 text-[#c3c5d9]">Privacy Policy</span></li>
                    <li><span class="text-xs font-medium leading-4 text-[#c3c5d9]">Support</span></li>
                </ul>
            </div>
        </div>
        <div class="mx-auto mt-12 max-w-7xl border-t border-white/10 px-8 pt-8 text-center">
            <p class="text-xs font-medium leading-4 text-[#c3c5d9]">&copy; {{ date('Y') }} YourJob. All rights reserved. Built for high-growth teams.</p>
        </div>
    </footer>
</body>
</html>
