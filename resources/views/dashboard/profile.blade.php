@extends('layouts.dashboard', ['title' => 'Profil Saya'])

@section('content')
<div class="max-w-2xl space-y-6">
    <!-- Profile header card -->
    <div class="card p-6 flex items-center gap-4">
        @php $avatar = $user->isSeeker() ? $profile->avatar : $profile->logo; @endphp
        @if ($avatar)
            <img src="{{ asset('storage/' . $avatar) }}" class="w-16 h-16 rounded-2xl object-cover ring-1 ring-ink-200">
        @else
            <div class="grid place-items-center w-16 h-16 rounded-2xl bg-brand-gradient text-white text-2xl font-extrabold">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <div>
            <h2 class="text-xl font-extrabold text-ink-900">{{ $user->isSeeker() ? $user->name : $profile->company_name }}</h2>
            <div class="flex items-center gap-2 mt-1">
                <x-badge color="brand" class="capitalize">{{ $user->role }}</x-badge>
                @if (! $user->isSeeker())
                    @if ($profile->is_verified)
                        <x-badge color="green">✓ Terverifikasi</x-badge>
                    @else
                        <x-badge color="amber">Menunggu Verifikasi</x-badge>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if ($user->isSeeker())
        <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="card p-6 space-y-5">
            @csrf @method('PUT')
            <h3 class="font-bold text-ink-900">Profil Pencari Kerja</h3>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="field">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="field">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kota</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="field">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Bio</label>
                <textarea name="bio" rows="3" class="field">{{ old('bio', $profile->bio) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Keahlian (pisahkan dengan koma)</label>
                <input type="text" name="skills" value="{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : '') }}" placeholder="PHP, Laravel, MySQL" class="field">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">CV (PDF)</label>
                    <input type="file" name="cv_file" accept="application/pdf" class="w-full text-sm text-ink-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:font-semibold file:cursor-pointer">
                    @if ($profile->cv_file)
                        <a href="{{ asset('storage/' . $profile->cv_file) }}" target="_blank" class="text-xs text-brand-600 hover:underline">📄 Lihat CV saat ini</a>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-ink-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:font-semibold file:cursor-pointer">
                </div>
            </div>
            <button class="btn-primary">💾 Simpan Profil</button>
        </form>
    @else
        <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="card p-6 space-y-5">
            @csrf @method('PUT')
            <h3 class="font-bold text-ink-900">Profil Perusahaan</h3>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Perusahaan</label>
                <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}" required class="field">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Industri</label>
                    <input type="text" name="industry" value="{{ old('industry', $profile->industry) }}" class="field">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kota</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="field">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Deskripsi Perusahaan</label>
                <textarea name="description" rows="4" class="field">{{ old('description', $profile->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Logo</label>
                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-ink-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:font-semibold file:cursor-pointer">
                @if ($profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" class="mt-3 w-16 h-16 rounded-xl object-cover ring-1 ring-ink-200">
                @endif
            </div>
            <button class="btn-primary">💾 Simpan Profil</button>
        </form>
    @endif
</div>
@endsection
