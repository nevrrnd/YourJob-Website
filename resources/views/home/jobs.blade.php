@extends('layouts.app')

@section('content')
<div class="px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-8">
        <section class="glass-panel rounded-3xl p-6 sm:p-8 lg:p-10">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Find Jobs</p>
                    <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-5xl">
                        Explore <span class="text-gradient">current openings</span>
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                        {{ number_format($jobs->total()) }} lowongan tersedia dari perusahaan di YourJob.
                    </p>
                </div>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="rounded-2xl bg-white/60 px-4 py-3">
                        <div class="text-xl font-extrabold text-slate-950">{{ number_format($jobs->total()) }}</div>
                        <div class="text-xs font-bold text-slate-500">Jobs</div>
                    </div>
                    <div class="rounded-2xl bg-white/60 px-4 py-3">
                        <div class="text-xl font-extrabold text-slate-950">{{ $categories->count() }}</div>
                        <div class="text-xs font-bold text-slate-500">Categories</div>
                    </div>
                    <div class="rounded-2xl bg-white/60 px-4 py-3">
                        <div class="text-xl font-extrabold text-slate-950">3</div>
                        <div class="text-xs font-bold text-slate-500">Modes</div>
                    </div>
                </div>
            </div>
        </section>

        <form action="{{ route('jobs.index') }}" method="GET" class="glass-panel grid gap-3 rounded-[2rem] p-3 sm:grid-cols-2 xl:grid-cols-[1.4fr_1fr_1fr_auto]">
            <label class="relative flex items-center rounded-full bg-white/55 px-4 py-3 focus-within:bg-white">
                <span class="material-symbols-outlined mr-3 text-[20px] text-slate-400">search</span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Job title, company, keyword" class="w-full border-none bg-transparent p-0 text-sm focus:ring-0">
            </label>
            <label class="relative flex items-center rounded-full bg-white/55 px-4 py-3 focus-within:bg-white">
                <span class="material-symbols-outlined mr-3 text-[20px] text-slate-400">location_on</span>
                <input type="text" name="city" value="{{ request('city') }}" placeholder="Location" class="w-full border-none bg-transparent p-0 text-sm focus:ring-0">
            </label>
            <select name="type" class="rounded-full border-white/60 bg-white/55 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-600/20">
                <option value="">Any Type</option>
                @foreach (['full_time'=>'Full Time','part_time'=>'Part Time','freelance'=>'Freelance','internship'=>'Magang','contract'=>'Kontrak'] as $val => $label)
                    <option value="{{ $val }}" @selected(request('type') === $val)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-7 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition hover:brightness-105">
                Search
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
        </form>

        @if ($categories->isNotEmpty())
            <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
                @foreach ($categories as $category)
                    <a href="{{ route('jobs.index', ['category' => $category->id]) }}" class="shrink-0 rounded-full border border-white/60 bg-white/70 px-4 py-2 text-sm font-bold text-slate-600 shadow-sm backdrop-blur transition hover:bg-blue-600 hover:text-white">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <section>
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($jobs as $job)
                    @include('partials.job-card', ['job' => $job])
                @empty
                    <div class="glass-panel rounded-3xl p-12 text-center md:col-span-2 xl:col-span-3">
                        <span class="material-symbols-outlined text-5xl text-slate-300">work_off</span>
                        <p class="mt-4 font-extrabold text-slate-950">No jobs found.</p>
                        <p class="mt-1 text-sm text-slate-500">Coba ubah keyword, lokasi, atau tipe pekerjaan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">{{ $jobs->links() }}</div>
        </section>
    </div>
</div>
@endsection
