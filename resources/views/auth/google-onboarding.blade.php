<x-guest-layout>
    <div x-data="{ role: 'seeker' }">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-extrabold text-[#1a1c1e]">Lengkapi Profil</h1>
            <p class="mt-2 text-sm text-[#737688]">Pilih peranmu di YourJob terlebih dahulu.</p>
        </div>

        <form method="POST" action="{{ route('google.onboarding.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer rounded-xl border-2 border-[#e5e7eb] p-4 text-center transition hover:border-[#003ec7] has-[:checked]:border-[#003ec7] has-[:checked]:bg-[#dde1ff]">
                    <input type="radio" name="role" value="seeker" class="sr-only" x-model="role" checked>
                    <span class="mb-2 block"><span class="material-symbols-outlined text-[#003ec7]">person_search</span></span>
                    <span class="block text-sm font-bold text-[#1a1c1e]">Pencari Kerja</span>
                    <span class="block text-xs text-[#737688]">Cari dan lamar lowongan</span>
                </label>
                <label class="cursor-pointer rounded-xl border-2 border-[#e5e7eb] p-4 text-center transition hover:border-[#003ec7] has-[:checked]:border-[#003ec7] has-[:checked]:bg-[#dde1ff]">
                    <input type="radio" name="role" value="employer" class="sr-only" x-model="role">
                    <span class="mb-2 block"><span class="material-symbols-outlined text-[#003ec7]">domain</span></span>
                    <span class="block text-sm font-bold text-[#1a1c1e]">Pemberi Kerja</span>
                    <span class="block text-xs text-[#737688]">Posting lowongan</span>
                </label>
            </div>

            <div>
                <label for="city" class="mb-1.5 block text-sm font-bold text-[#434656]">Kota</label>
                <input id="city" type="text" name="city" placeholder="Jakarta" class="field">
            </div>

            <div x-show="role === 'seeker'" class="space-y-4">
                <div>
                    <label for="phone" class="mb-1.5 block text-sm font-bold text-[#434656]">Nomor HP</label>
                    <input id="phone" type="text" name="phone" placeholder="08xxxxxxxxxx" class="field">
                </div>
                <div>
                    <label for="bio" class="mb-1.5 block text-sm font-bold text-[#434656]">Ringkasan Diri</label>
                    <textarea id="bio" name="bio" rows="3" placeholder="Ceritakan singkat pengalaman atau skill kamu" class="field"></textarea>
                </div>
            </div>

            <div x-show="role === 'employer'" class="space-y-4">
                <div>
                    <label for="company_name" class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Perusahaan</label>
                    <input id="company_name" type="text" name="company_name" placeholder="PT Nama Perusahaan" class="field">
                    <x-input-error :messages="$errors->get('company_name')" />
                </div>
                <div>
                    <label for="industry" class="mb-1.5 block text-sm font-bold text-[#434656]">Industri</label>
                    <input id="industry" type="text" name="industry" placeholder="Teknologi, Retail, Finance" class="field">
                </div>
                <div>
                    <label for="description" class="mb-1.5 block text-sm font-bold text-[#434656]">Deskripsi Perusahaan</label>
                    <textarea id="description" name="description" rows="3" placeholder="Ceritakan singkat tentang perusahaan" class="field"></textarea>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Simpan dan Lanjutkan</button>
        </form>
    </div>
</x-guest-layout>
