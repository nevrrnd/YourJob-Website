<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold premium-heading">Konfirmasi Password</h1>
        <p class="text-sm text-ink-500 mt-2">Masukkan password untuk melanjutkan area aman.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <x-primary-button class="w-full justify-center">
            Konfirmasi
        </x-primary-button>
    </form>
</x-guest-layout>
