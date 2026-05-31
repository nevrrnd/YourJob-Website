@extends('layouts.app')

@php
    $company = $job->employer?->companyProfile;
    $logo = $company?->logo ? asset('storage/' . $company->logo) : null;
    $isSeeker = auth()->check() && auth()->user()->isSeeker();
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ tab: 'desc' }">
    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-1 text-sm text-ink-500 hover:text-brand-600 transition">← Kembali ke daftar</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
        <!-- Main -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header card -->
            <div class="card p-6 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-gradient opacity-[0.07] rounded-full"></div>
                <div class="relative flex items-start gap-5">
                    <div class="grid place-items-center w-20 h-20 rounded-2xl bg-brand-50 ring-1 ring-brand-100 overflow-hidden shrink-0">
                        @if ($logo)<img src="{{ $logo }}" class="w-full h-full object-cover">@else<span class="text-3xl">{{ $job->category?->icon ?? '💼' }}</span>@endif
                    </div>
                    <div class="min-w-0">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-ink-900 leading-tight">{{ $job->title }}</h1>
                        <p class="text-ink-600 font-medium mt-1">🏢 {{ $company?->company_name ?? $job->employer?->name }}</p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            <x-badge color="brand">{{ $job->type_label }}</x-badge>
                            <x-badge color="sky">📍 {{ $job->location_label }}</x-badge>
                            <x-badge color="violet">{{ $job->experience_label }}</x-badge>
                            <x-badge color="gray">{{ $job->category?->name }}</x-badge>
                            @if ($job->status !== 'active')
                                <x-badge color="red">Ditutup</x-badge>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="card overflow-hidden">
                <div class="flex border-b border-ink-100 px-2">
                    @foreach (['desc' => 'Deskripsi', 'req' => 'Persyaratan', 'benefit' => 'Benefit'] as $key => $label)
                        <button @click="tab='{{ $key }}'"
                                :class="tab==='{{ $key }}' ? 'border-brand-600 text-brand-600' : 'border-transparent text-ink-500 hover:text-ink-700'"
                                class="px-4 py-3.5 text-sm font-semibold border-b-2 transition">{{ $label }}</button>
                    @endforeach
                </div>
                <div class="p-6 text-ink-700 leading-relaxed">
                    <div x-show="tab==='desc'" class="whitespace-pre-line">{{ $job->description }}</div>
                    <div x-show="tab==='req'" x-cloak class="whitespace-pre-line">{{ $job->requirements }}</div>
                    <div x-show="tab==='benefit'" x-cloak class="whitespace-pre-line">{{ $job->benefits ?: 'Tidak ada informasi benefit.' }}</div>
                </div>
            </div>

            @if ($company?->description)
                <div class="card p-6">
                    <h3 class="font-bold text-ink-900 mb-2">Tentang Perusahaan</h3>
                    <p class="text-sm text-ink-600 leading-relaxed whitespace-pre-line">{{ $company->description }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="card p-6 lg:sticky lg:top-24">
                <div class="rounded-2xl bg-gradient-to-br from-brand-50 to-violet-50 p-4 border border-brand-100">
                    <p class="text-xs font-semibold text-brand-600 uppercase tracking-wide">Estimasi Gaji</p>
                    <p class="text-xl font-extrabold text-ink-900 mt-1">{{ $job->salary_range }}</p>
                </div>

                <dl class="mt-4 space-y-2.5 text-sm">
                    <div class="flex items-center justify-between">
                        <dt class="text-ink-500">Lokasi</dt>
                        <dd class="font-semibold text-ink-800">{{ $job->city ?? 'Fleksibel' }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-ink-500">Tipe</dt>
                        <dd class="font-semibold text-ink-800">{{ $job->type_label }}</dd>
                    </div>
                    @if ($job->deadline)
                        <div class="flex items-center justify-between">
                            <dt class="text-ink-500">Deadline</dt>
                            <dd class="font-semibold text-ink-800">{{ $job->deadline->format('d M Y') }}</dd>
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <dt class="text-ink-500">Dilihat</dt>
                        <dd class="font-semibold text-ink-800">{{ $job->view_count }}x</dd>
                    </div>
                </dl>

                <hr class="my-5 border-ink-100">

                @guest
                    <a href="{{ route('login') }}" class="btn-primary w-full">Masuk untuk Melamar</a>
                @endguest

                @auth
                    @if ($isSeeker)
                        <button id="bookmarkBtn" data-url="{{ route('seeker.save', $job) }}"
                                class="btn w-full mb-3 border {{ $isSaved ? 'bg-amber-50 border-amber-300 text-amber-700' : 'bg-white border-ink-200 text-ink-600 hover:border-brand-300' }}">
                            <span id="bookmarkLabel">{{ $isSaved ? '🔖 Tersimpan' : '🔖 Simpan Lowongan' }}</span>
                        </button>

                        @if ($hasApplied)
                            <div class="w-full text-center py-3 bg-green-50 text-green-700 rounded-xl font-semibold border border-green-200">✓ Sudah Melamar</div>
                        @elseif ($job->status === 'active')
                            <form action="{{ route('seeker.apply', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Upload CV (PDF)</label>
                                    <input type="file" name="cv_file" accept="application/pdf" required class="w-full text-sm text-ink-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:font-semibold file:cursor-pointer">
                                    @error('cv_file')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Cover Letter (opsional)</label>
                                    <textarea name="cover_letter" rows="4" class="field text-sm" placeholder="Ceritakan kenapa kamu cocok...">{{ old('cover_letter') }}</textarea>
                                </div>
                                <button class="btn-primary w-full">Lamar Sekarang 🚀</button>
                            </form>
                        @else
                            <div class="w-full text-center py-3 bg-ink-100 text-ink-500 rounded-xl">Lowongan ditutup</div>
                        @endif
                    @else
                        <p class="text-sm text-ink-500 text-center">Hanya pencari kerja yang dapat melamar.</p>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

@if (auth()->check() && auth()->user()->isSeeker())
<script>
document.getElementById('bookmarkBtn')?.addEventListener('click', async function () {
    const btn = this;
    const res = await fetch(btn.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    });
    if (!res.ok) return;
    const data = await res.json();
    const label = document.getElementById('bookmarkLabel');
    if (data.saved) {
        label.textContent = '🔖 Tersimpan';
        btn.className = 'btn w-full mb-3 border bg-amber-50 border-amber-300 text-amber-700';
    } else {
        label.textContent = '🔖 Simpan Lowongan';
        btn.className = 'btn w-full mb-3 border bg-white border-ink-200 text-ink-600 hover:border-brand-300';
    }
});
</script>
@endif
@endsection
