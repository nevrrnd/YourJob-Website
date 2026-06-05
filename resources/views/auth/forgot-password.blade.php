<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold premium-heading">Reset Password</h1>
        <p class="text-sm text-ink-500 mt-2">Masukkan email akunmu, kami kirim link reset password.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="kamu@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <x-primary-button class="w-full justify-center">
            Kirim Link Reset
        </x-primary-button>
    </form>
</x-guest-layout>
