@extends('layouts.app')

@php
    $company = $job->employer?->companyProfile;
    $isSeeker = auth()->check() && auth()->user()->isSeeker();
    $companyName = $company?->company_name ?? $job->employer?->name;
@endphp

@section('content')
<div class="px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[1fr_360px]">
        <section class="glass-panel rounded-3xl p-6 sm:p-8">
            <a href="{{ route('jobs.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:underline">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to listings
            </a>

            <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                <div class="min-w-0">
                    <div class="mb-4 flex flex-wrap gap-2">
                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">{{ $job->type_label }}</span>
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">{{ $job->location_label }}</span>
                    </div>
                    <h1 class="text-3xl font-extrabold leading-tight text-slate-950 sm:text-5xl">{{ $job->title }}</h1>
                    <p class="mt-4 flex items-center gap-2 text-sm font-semibold text-slate-600">
                        <span class="material-symbols-outlined text-[18px] text-blue-600">domain</span>
                        {{ $companyName }} • {{ $job->city ?: $job->location_label }}
                    </p>
                </div>

                @auth
                    @if ($isSeeker)
                        <button id="bookmarkBtn" data-url="{{ route('seeker.save', $job) }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/60 bg-white/70 px-4 py-2 text-sm font-bold text-slate-600 shadow-sm transition hover:text-red-500">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                            <span id="bookmarkLabel">{{ $isSaved ? 'Saved' : 'Save' }}</span>
                        </button>
                    @endif
                @endauth
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                <div class="rounded-2xl bg-white/60 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Experience</p>
                    <p class="mt-2 font-extrabold text-slate-950">{{ $job->experience_label }}</p>
                </div>
                <div class="rounded-2xl bg-white/60 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Salary</p>
                    <p class="mt-2 font-extrabold text-slate-950">{{ $job->salary_range }}</p>
                </div>
                <div class="rounded-2xl bg-white/60 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Deadline</p>
                    <p class="mt-2 font-extrabold text-slate-950">{{ $job->deadline?->format('d M Y') ?? 'Flexible' }}</p>
                </div>
            </div>

            <div class="mt-10 space-y-8 text-slate-700">
                <section>
                    <h2 class="text-xl font-extrabold text-slate-950">Description</h2>
                    <p class="mt-3 whitespace-pre-line leading-7">{{ $job->description }}</p>
                </section>

                <section>
                    <h2 class="text-xl font-extrabold text-slate-950">Requirements</h2>
                    <p class="mt-3 whitespace-pre-line leading-7">{{ $job->requirements }}</p>
                </section>

                @if ($job->benefits)
                    <section>
                        <h2 class="text-xl font-extrabold text-slate-950">Benefits</h2>
                        <p class="mt-3 whitespace-pre-line leading-7">{{ $job->benefits }}</p>
                    </section>
                @endif
            </div>
        </section>

        <aside class="space-y-5">
            <div class="glass-panel rounded-3xl p-6">
                <div class="flex items-center gap-4">
                    <div class="grid h-14 w-14 shrink-0 place-items-center overflow-hidden rounded-2xl bg-blue-50 text-blue-600">
                        @if ($company?->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $companyName }}" class="h-full w-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-3xl">domain</span>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="truncate font-extrabold text-slate-950">{{ $companyName }}</p>
                        <p class="truncate text-sm font-semibold text-slate-500">{{ $company?->industry ?: 'Hiring company' }}</p>
                    </div>
                </div>

                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Views</span>
                        <span class="font-bold text-slate-950">{{ number_format($job->view_count) }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Status</span>
                        <span class="font-bold capitalize text-slate-950">{{ $job->status }}</span>
                    </div>
                </div>
            </div>

            @guest
                <div class="glass-panel rounded-3xl p-6">
                    <h2 class="text-xl font-extrabold text-slate-950">Apply for this job</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Masuk dulu untuk mengirim CV dan cover letter.</p>
                    <button type="button" @click="authModal = 'login'" class="mt-5 w-full rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition hover:brightness-105">
                        Apply Now
                    </button>
                </div>
            @endguest

            @auth
                @if ($isSeeker)
                    <div class="glass-panel rounded-3xl p-6">
                        @if ($hasApplied)
                            <div class="rounded-2xl bg-emerald-50 p-4 text-sm font-bold text-emerald-700">Kamu sudah melamar lowongan ini.</div>
                        @elseif ($job->status === 'active')
                            <h2 class="text-xl font-extrabold text-slate-950">Apply for this job</h2>
                            <form action="{{ route('seeker.apply', $job) }}" method="POST" enctype="multipart/form-data" class="mt-5 grid gap-4">
                                @csrf
                                <label class="space-y-2">
                                    <span class="text-sm font-bold text-slate-700">CV (PDF)</span>
                                    <input type="file" name="cv_file" accept="application/pdf" required class="field p-3 text-sm">
                                </label>
                                <label class="space-y-2">
                                    <span class="text-sm font-bold text-slate-700">Cover letter</span>
                                    <textarea name="cover_letter" rows="4" class="field" placeholder="Tulis pesan singkat...">{{ old('cover_letter') }}</textarea>
                                </label>
                                <button class="rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition hover:brightness-105">Apply Now</button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth
        </aside>
    </div>
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
    document.getElementById('bookmarkLabel').textContent = data.saved ? 'Saved' : 'Save';
});
</script>
@endif
@endsection
