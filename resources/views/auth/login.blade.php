<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#dde1ff] text-[#003ec7]">
            <span class="material-symbols-outlined">login</span>
        </div>
        <h1 class="text-2xl font-extrabold text-[#1a1c1e]">Masuk Akun</h1>
        <p class="mt-2 text-sm text-[#737688]">Masuk untuk melanjutkan ke YourJob</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="device_model" class="js-device-model">
        <input type="hidden" name="client_platform" class="js-client-platform">
        <input type="hidden" name="client_platform_version" class="js-client-platform-version">
        <input type="hidden" name="client_architecture" class="js-client-architecture">

        <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border border-[#c3c5d9] bg-white px-5 py-3 text-sm font-bold text-[#434656] shadow-sm transition hover:border-[#003ec7] hover:text-[#003ec7]">
            <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
            Masuk dengan Google
        </a>

        <div class="flex items-center gap-3 text-xs font-semibold text-[#737688]">
            <span class="h-px flex-1 bg-[#e5e7eb]"></span>
            atau email
            <span class="h-px flex-1 bg-[#e5e7eb]"></span>
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-bold text-[#434656]">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email" class="field">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-bold text-[#434656]">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi" class="field">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[#c3c5d9] text-[#003ec7] shadow-sm focus:ring-[#003ec7]/30" name="remember">
                <span class="ms-2 text-sm text-[#434656]">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-[#003ec7] hover:text-[#002f9c]" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full py-3">Masuk</button>

        <p class="text-center text-sm text-[#737688]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-[#003ec7] hover:text-[#002f9c]">Daftar gratis</a>
        </p>
    </form>
</x-guest-layout>
