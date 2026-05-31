<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#2c7da0]/10 text-[#155e75] mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586l6.257-6.257A6 6 0 1121 9z" />
            </svg>
        </div>
        <h1 class="text-2xl font-extrabold premium-heading">Masuk Akun</h1>
        <p class="text-sm text-ink-500 mt-2">Masuk untuk melanjutkan ke YourJob</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
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
            <label for="email" class="block text-sm font-bold text-ink-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="Email"
                   class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-ink-700 mb-1.5">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="Kata Sandi"
                   class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-ink-300 text-[#2c7da0] shadow-sm focus:ring-[#2c7da0]/30" name="remember">
                <span class="ms-2 text-sm text-ink-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-[#1e4a6e] hover:text-[#2c7da0]" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full py-3">
            Masuk
        </button>

        <p class="text-center text-xs text-ink-400">Demo: gunakan akun yang sudah terdaftar</p>

        <p class="text-center text-sm text-ink-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-[#1e4a6e] hover:text-[#2c7da0]">Daftar gratis</a>
        </p>
    </form>
</x-guest-layout>
