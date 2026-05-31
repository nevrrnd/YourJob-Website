<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold premium-heading">Buat akun baru</h1>
        <p class="text-sm text-ink-500 mt-2">Setelah daftar, kamu bisa pilih peran dan lengkapi profil.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
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
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama kamu" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="kamu@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi')" />
                <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Daftar Sekarang') }}
        </x-primary-button>

        <p class="text-center text-sm text-ink-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-brand-600 hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
