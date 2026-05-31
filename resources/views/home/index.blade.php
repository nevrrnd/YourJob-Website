@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2c7da0]/10 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-[#48b5d0]/10 blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
        <div class="max-w-3xl mx-auto text-center animate-fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#2c7da0]/10 border border-[#2c7da0]/30 text-sm font-semibold text-[#155e75]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#2c7da0]"></span>
                {{ number_format($stats['jobs']) }}+ lowongan aktif menanti
            </span>
            <h1 class="mt-6 text-4xl sm:text-6xl font-extrabold premium-heading">
                Bangun karier tanpa batas <br class="hidden sm:block"> bersama perusahaan top
            </h1>
            <p class="mt-5 text-lg text-ink-600 max-w-2xl mx-auto leading-relaxed">
                Temukan peran yang sesuai dengan skill dan passionmu. Proses cepat, transparan, dan terpercaya.
            </p>

            <form action="{{ route('jobs.index') }}" method="GET"
                  class="mt-8 bg-white/90 backdrop-blur rounded-[2.5rem] shadow-lift p-2 sm:pl-6 flex flex-col sm:flex-row gap-2 max-w-3xl mx-auto border border-white/80">
                <div class="flex-1 flex items-center gap-2 px-3">
                    <svg class="w-5 h-5 text-ink-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Posisi atau kata kunci"
                           class="flex-1 border-0 bg-transparent text-ink-800 placeholder-ink-400 focus:ring-0 py-2.5">
                </div>
                <div class="hidden sm:block w-px bg-ink-200 my-2"></div>
                <div class="flex-1 flex items-center gap-2 px-3">
                    <svg class="w-5 h-5 text-ink-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="city" value="{{ request('city') }}" placeholder="Lokasi"
                           class="flex-1 border-0 bg-transparent text-ink-800 placeholder-ink-400 focus:ring-0 py-2.5">
                </div>
                <button class="btn-primary px-8 py-3">Jelajahi</button>
            </form>

            <p class="mt-4 text-sm text-ink-400">Populer: Developer, Designer, Marketing, Finance</p>
        </div>

        <div class="mt-14 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto premium-panel rounded-[2rem] p-6">
            @foreach ([
                [number_format($stats['jobs']), 'Lowongan Aktif'],
                [number_format($stats['companies']), 'Perusahaan Terverifikasi'],
                [number_format($stats['seekers']), 'Pelamar Terdaftar'],
            ] as [$value, $label])
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl font-extrabold text-ink-900">{{ $value }}</div>
                    <div class="text-ink-500 text-sm mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <span class="eyebrow">Kategori</span>
        <h2 class="mt-2 text-3xl font-extrabold text-ink-900">Jelajahi berdasarkan bidang</h2>
        <p class="mt-2 text-ink-500">Temukan peluang di industri yang kamu minati</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach ($categories as $category)
            <a href="{{ route('jobs.index', ['category' => $category->id]) }}"
               class="group card card-hover p-5 flex items-center gap-4">
                <div class="grid place-items-center w-12 h-12 rounded-2xl bg-white text-xl text-[#2c7da0] shadow-soft transition">{{ $category->icon }}</div>
                <div class="min-w-0">
                    <div class="font-semibold text-ink-800 truncate group-hover:text-brand-600 transition">{{ $category->name }}</div>
                    <div class="text-xs text-ink-400">{{ $category->jobs_count }} lowongan</div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-white/45 border-y border-white/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="eyebrow">Terbaru</span>
                <h2 class="mt-2 text-3xl font-extrabold text-ink-900">Lowongan terkini</h2>
            </div>
            <a href="{{ route('jobs.index') }}" class="btn-ghost btn-sm">Lihat semua</a>
        </div>
        @if ($latestJobs->isEmpty())
            <div class="card p-12 text-center text-ink-500">Belum ada lowongan tersedia.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($latestJobs as $job)
                    @include('partials.job-card', ['job' => $job])
                @endforeach
            </div>
        @endif
    </div>
</section>

@guest
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="rounded-[2rem] px-8 py-12 sm:px-14 sm:py-14 text-white" style="background: linear-gradient(105deg, #1e4a6e, #2c7da0);">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Siap memulai karier baru?</h3>
                <p class="mt-2 text-brand-100">Buat akun gratis dan lamar lowongan pertamamu hari ini.</p>
            </div>
            <div class="flex gap-3 shrink-0">
                <button type="button" @click="authModal = 'register'" class="btn !bg-white !text-brand-700 hover:!bg-ink-100 px-6 py-3">Daftar Sekarang</button>
                <a href="{{ route('jobs.index') }}" class="btn !bg-brand-500 !text-white hover:!bg-brand-400 px-6 py-3">Lihat Lowongan</a>
            </div>
        </div>
    </div>
</section>
@endguest
@endsection
