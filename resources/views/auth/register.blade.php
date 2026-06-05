<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#dde1ff] text-[#003ec7]">
            <span class="material-symbols-outlined">person_add</span>
        </div>
        <h1 class="text-2xl font-extrabold text-[#1a1c1e]">Buat akun baru</h1>
        <p class="mt-2 text-sm text-[#737688]">Pilih peran dan lengkapi profil setelah daftar.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border border-[#c3c5d9] bg-white px-5 py-3 text-sm font-bold text-[#434656] shadow-sm transition hover:border-[#003ec7] hover:text-[#003ec7]">
            <span class="grid h-5 w-5 place-items-center rounded-full bg-white text-sm font-extrabold text-[#4285f4]">G</span>
            Daftar dengan Google
        </a>

        <div class="flex items-center gap-3 text-xs font-semibold text-[#737688]">
            <span class="h-px flex-1 bg-[#e5e7eb]"></span>
            atau daftar manual
            <span class="h-px flex-1 bg-[#e5e7eb]"></span>
        </div>

        <div>
            <label for="name" class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Lengkap</label>
            <input id="name" class="field" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama kamu">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-bold text-[#434656]">Email</label>
            <input id="email" class="field" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="kamu@email.com">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-1.5 block text-sm font-bold text-[#434656]">Password</label>
                <input id="password" class="field" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-bold text-[#434656]">Konfirmasi</label>
                <input id="password_confirmation" class="field" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi">
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
        </div>

        <button class="btn-primary w-full py-3">Daftar Sekarang</button>

        <p class="text-center text-sm text-[#737688]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-[#003ec7] hover:text-[#002f9c]">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
