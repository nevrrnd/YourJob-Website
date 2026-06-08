@extends('layouts.app', ['title' => 'YourJob'])

@section('content')
@php
    $popularSearches = ['Frontend Engineer', 'Remote', 'Product Designer', 'Data Scientist'];
    $remoteCount = $latestJobs->filter(fn ($job) => str_contains(strtolower($job->location_label ?? ''), 'remote') || str_contains(strtolower($job->type_label ?? ''), 'remote'))->count();
@endphp

<div class="bg-slate-50">
    <section class="relative overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-slate-50">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-grid-faint [background-size:44px_44px] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_0%,black,transparent)]"></div>
            <div class="absolute -left-20 -top-10 h-80 w-80 rounded-full bg-blue-400/40 blur-3xl animate-blob sm:h-[28rem] sm:w-[28rem]"></div>
            <div class="absolute right-0 top-16 h-80 w-80 rounded-full bg-violet-400/35 blur-3xl animate-blob-slow [animation-delay:-4s] sm:h-[26rem] sm:w-[26rem]"></div>
            <div class="absolute -bottom-10 left-1/3 h-72 w-72 rounded-full bg-amber-300/30 blur-3xl animate-blob [animation-delay:-8s] sm:h-96 sm:w-96"></div>
        </div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 sm:py-16 lg:min-h-[calc(100vh-4rem)] lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
            <div>
                <h1 class="max-w-4xl animate-fade-up text-3xl font-extrabold leading-tight tracking-tight text-slate-950 [animation-delay:80ms] sm:text-5xl lg:text-6xl">
                    Temukan karier berikutnya dengan <span class="text-blue-600">momentum</span> yang tepat.
                </h1>
                <p class="mt-4 max-w-2xl animate-fade-up text-base leading-7 text-slate-600 [animation-delay:160ms] sm:mt-6 sm:text-lg sm:leading-8">
                    Jelajahi lowongan pilihan, simpan pekerjaan favorit, dan kirim lamaran dari satu tempat yang rapi.
                </p>

                <form action="{{ route('jobs.index') }}" method="GET" class="mt-7 grid animate-fade-up gap-3 rounded-2xl border border-slate-200 bg-white/80 p-3 shadow-2xl shadow-blue-200/40 backdrop-blur [animation-delay:240ms] sm:mt-10 md:grid-cols-[1fr_1fr_auto]">
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-slate-400">search</span>
                        <input name="q" value="{{ request('q') }}" class="min-h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" placeholder="Job title, company, keyword">
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-slate-400">location_on</span>
                        <input name="city" value="{{ request('city') }}" class="min-h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" placeholder="City or Remote">
                    </div>
                    <button class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700 active:scale-[0.98]">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                        Find Jobs
                    </button>
                </form>

                <div class="mt-6 flex animate-fade-up flex-wrap items-center gap-2 [animation-delay:320ms]">
                    <span class="text-sm font-semibold text-slate-500">Popular:</span>
                    @foreach ($popularSearches as $item)
                        <a href="{{ route('jobs.index', ['q' => $item]) }}" class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-blue-50 hover:text-blue-600">
                            {{ $item }}
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 flex animate-fade-up items-center gap-4 [animation-delay:400ms]">
                    <div class="flex -space-x-3">
                        @foreach (['bg-blue-500', 'bg-violet-500', 'bg-amber-500', 'bg-emerald-500'] as $bg)
                            <span class="inline-block h-9 w-9 rounded-full {{ $bg }} ring-2 ring-white"></span>
                        @endforeach
                    </div>
                    <div class="text-sm">
                        <div class="text-base leading-none text-amber-400">★★★★★</div>
                        <p class="mt-1 font-medium text-slate-600">Dipercaya {{ number_format($stats['seekers']) }}+ talenta &amp; perusahaan</p>
                    </div>
                </div>
            </div>

            <div class="relative animate-fade-in [animation-delay:300ms]">
                <div class="absolute -inset-4 -z-10 rounded-[2.5rem] bg-blue-500/10 blur-2xl"></div>
                <div class="rounded-[2rem] bg-slate-950 p-3 shadow-2xl shadow-slate-300/80 sm:p-4 lg:animate-float-slow">
                    <div class="rounded-[1.5rem] bg-white p-4 sm:p-5">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-500">Live opportunities</p>
                                <h2 class="text-xl font-bold text-slate-950 sm:text-2xl">{{ $latestJobs->count() }} featured jobs</h2>
                            </div>
                            <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-700">
                                {{ $remoteCount }} remote
                            </span>
                        </div>
                        <div class="mt-5 space-y-3">
                            @forelse ($latestJobs->take(4) as $job)
                                @php $company = $job->employer?->companyProfile; @endphp
                                <a href="{{ route('jobs.show', $job) }}" class="block rounded-2xl border border-slate-100 p-4 transition hover:border-blue-600 hover:bg-blue-50/60">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="min-w-0">
                                            <h3 class="truncate font-semibold text-slate-950">{{ $job->title }}</h3>
                                            <p class="mt-1 truncate text-sm text-slate-500">{{ $company?->company_name ?? $job->employer?->name }} - {{ $job->location_label }}</p>
                                        </div>
                                        <span class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ $job->type_label }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="rounded-2xl border border-slate-100 p-4 text-sm text-slate-500">Belum ada lowongan pilihan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-slate-950 py-14 text-white sm:py-20">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute inset-0 bg-grid-faint opacity-[0.15] [background-size:40px_40px]"></div>
            <div class="absolute left-1/4 top-0 h-64 w-64 -translate-y-1/2 rounded-full bg-blue-600/30 blur-3xl"></div>
            <div class="absolute right-1/4 bottom-0 h-64 w-64 translate-y-1/2 rounded-full bg-violet-600/25 blur-3xl"></div>
        </div>
        <div class="relative mx-auto grid max-w-7xl gap-6 px-4 text-center sm:gap-8 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <div class="text-4xl font-extrabold text-white sm:text-5xl">{{ number_format($stats['jobs']) }}+</div>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-blue-300 sm:text-sm">Active jobs</p>
            </div>
            <div class="border-y border-white/10 py-6 sm:py-8 md:border-x md:border-y-0 md:py-0">
                <div class="text-4xl font-extrabold text-white sm:text-5xl">{{ number_format($stats['companies']) }}</div>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-blue-300 sm:text-sm">Companies</p>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-white sm:text-5xl">{{ number_format($stats['seekers']) }}</div>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-blue-300 sm:text-sm">Simple profiles</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-20 lg:px-8">
        <div class="grid gap-10 sm:gap-12 lg:grid-cols-2">
            @foreach ([
                ['Untuk kandidat', 'Cari kerja tanpa ribet', [
                    ['Lamaran lebih cepat', 'Profil dan riwayat lamaran tersimpan, jadi apply tidak perlu mulai dari nol.'],
                    ['Info penting di awal', 'Lihat lokasi, tipe kerja, pengalaman, dan estimasi gaji sebelum lanjut.'],
                    ['Pekerjaan yang relevan', 'Filter dan pencarian membantu kamu fokus ke role yang cocok.'],
                ]],
                ['Untuk perusahaan', 'Temukan talenta lebih cepat', [
                    ['Kandidat siap kerja', 'Tampilkan lowongan secara jelas agar kandidat memahami kebutuhan role.'],
                    ['Pipeline sederhana', 'Lamaran masuk bisa dipantau dari dashboard yang ringkas.'],
                    ['Brand terlihat rapi', 'Lowongan tampil modern, konsisten, dan mudah dibaca di semua layar.'],
                ]],
            ] as [$eyebrow, $title, $items])
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-600">{{ $eyebrow }}</p>
                    <h2 class="mt-3 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">{{ $title }}</h2>
                    <div class="mt-8 space-y-6">
                        @foreach ($items as [$itemTitle, $description])
                            <div class="flex gap-4">
                                <div class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-black text-blue-600">+</div>
                                <div>
                                    <h3 class="font-semibold text-slate-950">{{ $itemTitle }}</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-14 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Featured</p>
                    <h2 class="mt-3 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Lowongan pilihan</h2>
                    <p class="mt-2 text-sm text-slate-600">Hand-picked opportunities dari data project kamu.</p>
                </div>
                <a href="{{ route('jobs.index') }}" class="text-sm font-bold text-blue-600 hover:underline">
                    View all jobs
                </a>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($latestJobs->take(6) as $job)
                    @include('partials.job-card', ['job' => $job])
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
