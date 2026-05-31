<x-guest-layout>
    <div x-data="{ role: 'seeker' }">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-extrabold premium-heading">Lengkapi Profil</h1>
            <p class="text-sm text-ink-500 mt-2">Pilih peranmu di YourJob terlebih dahulu.</p>
        </div>

        <form method="POST" action="{{ route('google.onboarding.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer rounded-2xl border-2 border-ink-200 p-4 text-center transition hover:border-[#2c7da0] has-[:checked]:border-[#2c7da0] has-[:checked]:bg-[#2c7da0]/10">
                    <input type="radio" name="role" value="seeker" class="sr-only" x-model="role" checked>
                    <span class="block text-sm font-bold text-ink-800">Pencari Kerja</span>
                    <span class="block text-xs text-ink-400">Cari dan lamar lowongan</span>
                </label>
                <label class="cursor-pointer rounded-2xl border-2 border-ink-200 p-4 text-center transition hover:border-[#2c7da0] has-[:checked]:border-[#2c7da0] has-[:checked]:bg-[#2c7da0]/10">
                    <input type="radio" name="role" value="employer" class="sr-only" x-model="role">
                    <span class="block text-sm font-bold text-ink-800">Pemberi Kerja</span>
                    <span class="block text-xs text-ink-400">Posting lowongan</span>
                </label>
            </div>

            <div>
                <label for="city" class="block text-sm font-bold text-ink-700 mb-1.5">Kota</label>
                <input id="city" type="text" name="city" placeholder="Jakarta" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
            </div>

            <div x-show="role === 'seeker'" class="space-y-4">
                <div>
                    <label for="phone" class="block text-sm font-bold text-ink-700 mb-1.5">Nomor HP</label>
                    <input id="phone" type="text" name="phone" placeholder="08xxxxxxxxxx" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                </div>
                <div>
                    <label for="bio" class="block text-sm font-bold text-ink-700 mb-1.5">Ringkasan Diri</label>
                    <textarea id="bio" name="bio" rows="3" placeholder="Ceritakan singkat pengalaman atau skill kamu" class="w-full rounded-3xl border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20"></textarea>
                </div>
            </div>

            <div x-show="role === 'employer'" class="space-y-4">
                <div>
                    <label for="company_name" class="block text-sm font-bold text-ink-700 mb-1.5">Nama Perusahaan</label>
                    <input id="company_name" type="text" name="company_name" placeholder="PT Nama Perusahaan" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                    <x-input-error :messages="$errors->get('company_name')" />
                </div>
                <div>
                    <label for="industry" class="block text-sm font-bold text-ink-700 mb-1.5">Industri</label>
                    <input id="industry" type="text" name="industry" placeholder="Teknologi, Retail, Finance" class="w-full rounded-full border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20">
                </div>
                <div>
                    <label for="description" class="block text-sm font-bold text-ink-700 mb-1.5">Deskripsi Perusahaan</label>
                    <textarea id="description" name="description" rows="3" placeholder="Ceritakan singkat tentang perusahaan" class="w-full rounded-3xl border border-ink-200 bg-white px-5 py-3 text-ink-800 placeholder-ink-400 shadow-xs transition focus:border-[#2c7da0] focus:ring-2 focus:ring-[#2c7da0]/20"></textarea>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Simpan dan Lanjutkan</button>
        </form>
    </div>
</x-guest-layout>
