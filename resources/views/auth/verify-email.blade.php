<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold premium-heading">Verifikasi Email</h1>
        <p class="text-sm text-ink-500 mt-2">Cek emailmu dan klik link verifikasi untuk melanjutkan.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
            Link verifikasi baru sudah dikirim.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>Kirim Ulang</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost">Keluar</button>
        </form>
    </div>
</x-guest-layout>
