@extends('layouts.app')

@php
    $company = $job->employer?->companyProfile;
    $isSeeker = auth()->check() && auth()->user()->isSeeker();
@endphp

@section('content')
<div class="mx-auto max-w-6xl space-y-6 p-4 sm:p-6 lg:p-8">
    <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">Back to listings</a>

    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200/75 sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">{{ $job->title }}</h1>
                <p class="mt-2 text-sm text-slate-600">{{ $company?->company_name ?? $job->employer?->name }} - {{ $job->location_label }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @auth
                    @if ($isSeeker)
                        <button id="bookmarkBtn" data-url="{{ route('seeker.save', $job) }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:text-red-500">
                            <span id="bookmarkLabel">{{ $isSaved ? '♥ Saved' : '♡ Save' }}</span>
                        </button>
                    @endif
                @endauth
                @guest
                    <button type="button" @click="authModal = 'login'" class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">Apply</button>
                @endguest
            </div>
        </div>

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Type</p>
                <p class="mt-1 font-semibold text-slate-950">{{ $job->type_label }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Experience</p>
                <p class="mt-1 font-semibold text-slate-950">{{ $job->experience_label }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Salary</p>
                <p class="mt-1 font-semibold text-slate-950">{{ $job->salary_range }}</p>
            </div>
        </div>

        <div class="prose mt-8 max-w-none text-slate-700">
            <h2 class="text-xl font-bold text-slate-950">Description</h2>
            <p class="whitespace-pre-line">{{ $job->description }}</p>

            <h2 class="mt-6 text-xl font-bold text-slate-950">Requirements</h2>
            <p class="whitespace-pre-line">{{ $job->requirements }}</p>

            @if ($job->benefits)
                <h2 class="mt-6 text-xl font-bold text-slate-950">Benefits</h2>
                <p class="whitespace-pre-line">{{ $job->benefits }}</p>
            @endif
        </div>
    </div>

    @auth
        @if ($isSeeker)
            <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200/75 sm:p-6">
                @if ($hasApplied)
                    <div class="rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-700">Kamu sudah melamar lowongan ini.</div>
                @elseif ($job->status === 'active')
                    <h2 class="text-xl font-semibold text-slate-950">Apply for this job</h2>
                    <form action="{{ route('seeker.apply', $job) }}" method="POST" enctype="multipart/form-data" class="mt-4 grid gap-4 sm:max-w-xl">
                        @csrf
                        <label class="space-y-2">
                            <span class="text-sm font-medium text-slate-700">CV (PDF)</span>
                            <input type="file" name="cv_file" accept="application/pdf" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-3 text-sm">
                        </label>
                        <label class="space-y-2">
                            <span class="text-sm font-medium text-slate-700">Cover letter</span>
                            <textarea name="cover_letter" rows="4" class="field" placeholder="Tulis pesan singkat...">{{ old('cover_letter') }}</textarea>
                        </label>
                        <button class="inline-flex items-center rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Apply</button>
                    </form>
                @endif
            </div>
        @endif
    @endauth
</div>

@if (auth()->check() && auth()->user()->isSeeker())
<script>
document.getElementById('bookmarkBtn')?.addEventListener('click', async function () {
    const res = await fetch(this.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    });
    if (!res.ok) return;
    const data = await res.json();
    document.getElementById('bookmarkLabel').textContent = data.saved ? '♥ Saved' : '♡ Save';
});
</script>
@endif
@endsection
