@extends('layouts.dashboard', ['title' => 'Profil Saya'])

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="card flex items-center gap-5 p-6">
        @php $avatar = $user->isSeeker() ? $profile->avatar : $profile->logo; @endphp
        @if ($avatar)
            <img src="{{ asset('storage/' . $avatar) }}" class="h-16 w-16 rounded-xl object-cover ring-1 ring-[#e5e7eb]">
        @else
            <div class="grid h-16 w-16 place-items-center rounded-xl bg-[#003ec7] text-2xl font-extrabold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <div>
            <h2 class="text-2xl font-extrabold text-[#1a1c1e]">{{ $user->isSeeker() ? $user->name : $profile->company_name }}</h2>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                <x-badge color="brand" class="capitalize">{{ $user->role }}</x-badge>
                @if (! $user->isSeeker())
                    @if ($profile->is_verified)
                        <x-badge color="green">Terverifikasi</x-badge>
                    @else
                        <x-badge color="amber">Menunggu Verifikasi</x-badge>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if ($user->isSeeker())
        <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="card space-y-5 p-6">
            @csrf @method('PUT')
            <h3 class="text-xl font-extrabold text-[#1a1c1e]">Profil Pencari Kerja</h3>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="field">
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="field">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Kota</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="field">
                </div>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Bio</label>
                <textarea name="bio" rows="3" class="field">{{ old('bio', $profile->bio) }}</textarea>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Keahlian</label>
                <input type="text" name="skills" value="{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : '') }}" placeholder="PHP, Laravel, MySQL" class="field">
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">CV (PDF)</label>
                    <input type="file" name="cv_file" accept="application/pdf" class="w-full text-sm text-[#434656] file:mr-3 file:rounded-lg file:border-0 file:bg-[#dde1ff] file:px-3 file:py-2 file:font-bold file:text-[#003ec7]">
                    @if ($profile->cv_file)
                        <a href="{{ asset('storage/' . $profile->cv_file) }}" target="_blank" class="mt-2 inline-flex text-xs font-bold text-[#003ec7] hover:underline">Lihat CV saat ini</a>
                    @endif
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-[#434656] file:mr-3 file:rounded-lg file:border-0 file:bg-[#dde1ff] file:px-3 file:py-2 file:font-bold file:text-[#003ec7]">
                </div>
            </div>
            <button class="btn-primary">Simpan Profil</button>
        </form>
    @else
        <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="card space-y-5 p-6">
            @csrf @method('PUT')
            <h3 class="text-xl font-extrabold text-[#1a1c1e]">Profil Perusahaan</h3>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Perusahaan</label>
                <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}" required class="field">
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Industri</label>
                    <input type="text" name="industry" value="{{ old('industry', $profile->industry) }}" class="field">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Kota</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="field">
                </div>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Deskripsi Perusahaan</label>
                <textarea name="description" rows="4" class="field">{{ old('description', $profile->description) }}</textarea>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">Logo</label>
                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-[#434656] file:mr-3 file:rounded-lg file:border-0 file:bg-[#dde1ff] file:px-3 file:py-2 file:font-bold file:text-[#003ec7]">
                @if ($profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" class="mt-3 h-16 w-16 rounded-xl object-cover ring-1 ring-[#e5e7eb]">
                @endif
            </div>
            <button class="btn-primary">Simpan Profil</button>
        </form>
    @endif
</div>
@endsection
