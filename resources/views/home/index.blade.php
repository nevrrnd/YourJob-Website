@extends('layouts.app', ['title' => 'YourJob'])

@section('content')
@php
    // Preset posisi & kedalaman untuk chip kategori yang melayang (parallax).
    $chipStyles = [
        ['pos' => 'top-[10%] left-[6%]',   'depth' => '',                        'speed' => 1.5, 'show' => 'hidden md:flex', 'accent' => false],
        ['pos' => 'top-[12%] right-[7%]',  'depth' => '',                        'speed' => 1.2, 'show' => 'hidden md:flex', 'accent' => true],
        ['pos' => 'top-[30%] left-[12%]',  'depth' => 'opacity-90',              'speed' => 2.0, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[34%] right-[13%]', 'depth' => 'opacity-90',              'speed' => 1.8, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[55%] left-[5%]',   'depth' => 'blur-[1px] opacity-70',   'speed' => 0.8, 'show' => 'hidden xl:flex', 'accent' => false],
        ['pos' => 'top-[58%] right-[6%]',  'depth' => '',                        'speed' => 1.1, 'show' => 'hidden xl:flex', 'accent' => false],
        ['pos' => 'top-[74%] left-[14%]',  'depth' => '',                        'speed' => 1.4, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[78%] right-[15%]', 'depth' => 'opacity-80',              'speed' => 0.7, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[20%] right-[32%]', 'depth' => 'blur-[0.5px] opacity-70', 'speed' => 0.9, 'show' => 'hidden xl:flex', 'accent' => false],
        ['pos' => 'top-[84%] left-[34%]',  'depth' => 'blur-[1px] opacity-60',   'speed' => 0.6, 'show' => 'hidden xl:flex', 'accent' => false],
    ];
    $chipIcons = ['code', 'security', 'brush', 'database', 'bar_chart', 'home_work', 'memory', 'smartphone', 'architecture', 'cloud'];
    $fallbackChips = collect([
        ['name' => 'Teknologi & IT', 'url' => route('jobs.index', ['q' => 'Teknologi'])],
        ['name' => 'Desain & Kreatif', 'url' => route('jobs.index', ['q' => 'Desain'])],
        ['name' => 'Marketing & Sales', 'url' => route('jobs.index', ['q' => 'Marketing'])],
        ['name' => 'Keuangan', 'url' => route('jobs.index', ['q' => 'Keuangan'])],
        ['name' => 'Pendidikan', 'url' => route('jobs.index', ['q' => 'Pendidikan'])],
        ['name' => 'Kesehatan', 'url' => route('jobs.index', ['q' => 'Kesehatan'])],
        ['name' => 'Logistik', 'url' => route('jobs.index', ['q' => 'Logistik'])],
        ['name' => 'Lainnya', 'url' => route('jobs.index')],
    ]);
    $chipCategories = $categories
        ->take(count($chipStyles))
        ->map(fn ($category) => ['name' => $category->name, 'url' => route('jobs.index', ['category' => $category->id])])
        ->values();
    $heroChips = $chipCategories->isNotEmpty() ? $chipCategories : $fallbackChips;
@endphp

<div class="bg-slate-50">
    {{-- ============================= HERO ============================= --}}
    <section class="parallax-wrapper relative flex min-h-[calc(100vh-4rem)] flex-col justify-center overflow-hidden bg-gradient-to-b from-blue-50/50 via-white to-slate-50 px-4 pb-20 pt-12 sm:px-6 lg:px-8">
        {{-- Background lembut statis (tanpa animasi, seperti acuan) --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-grid-faint [background-size:44px_44px] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_0%,black,transparent)]"></div>
            <div class="absolute -left-20 -top-10 h-80 w-80 rounded-full bg-blue-400/20 blur-3xl sm:h-[28rem] sm:w-[28rem]"></div>
            <div class="absolute right-0 top-16 h-80 w-80 rounded-full bg-violet-accent/20 blur-3xl sm:h-[26rem] sm:w-[26rem]"></div>
        </div>

        {{-- Floating chips kategori (parallax) --}}
        <div id="chip-container" class="pointer-events-none absolute inset-0 z-0 hidden md:block">
            @foreach ($heroChips as $i => $category)
                @php $s = $chipStyles[$i]; @endphp
                <a href="{{ $category['url'] }}"
                   data-speed="{{ $s['speed'] }}"
                   title="Lihat lowongan {{ $category['name'] }}"
                   class="chip group pointer-events-auto absolute {{ $s['pos'] }} {{ $s['show'] }} items-center gap-2 rounded-full border px-5 py-2.5 shadow-sm {{ $s['depth'] }} hover:z-20 hover:scale-110 hover:opacity-100 hover:shadow-xl hover:blur-none active:scale-95 {{ $s['accent'] ? 'border-violet-200 bg-violet-50 hover:border-violet-accent hover:bg-violet-accent hover:shadow-violet-accent/30' : 'border-white/60 bg-white/80 backdrop-blur-sm hover:border-blue-600 hover:bg-blue-600 hover:shadow-blue-600/30' }}">
                    <span class="material-symbols-outlined text-[20px] {{ $s['accent'] ? 'text-violet-accent' : 'text-blue-600' }} group-hover:text-white">{{ $chipIcons[$i] }}</span>
                    <span class="whitespace-nowrap text-sm font-semibold {{ $s['accent'] ? 'text-violet-700' : 'text-slate-600' }} group-hover:text-white">{{ $category['name'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- Konten hero terpusat --}}
        <div class="relative z-10 mx-auto flex w-full max-w-4xl flex-col items-center text-center">
            {{-- Badge --}}
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/70 px-4 py-1.5 shadow-sm backdrop-blur-sm animate-fade-up">
                <span class="material-symbols-outlined text-[16px] text-blue-600" style="font-variation-settings: 'FILL' 1;">stars</span>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">{{ number_format($stats['jobs']) }}+ lowongan tersedia</span>
            </div>

            <h1 class="mb-6 max-w-4xl text-balance text-4xl font-extrabold leading-[1.08] tracking-tight text-slate-950 animate-fade-up [animation-delay:80ms] sm:text-5xl lg:text-6xl">
                Temukan <span class="text-gradient">Pekerjaan Impianmu</span> Lebih Cepat
            </h1>
            <p class="mb-12 max-w-2xl text-balance text-base leading-7 text-slate-600 animate-fade-up [animation-delay:160ms] sm:text-lg">
                Cara modern menghubungkan talenta terbaik dengan perusahaan paling inovatif. Langkah karier berikutmu hanya berjarak satu pencarian.
            </p>

            {{-- Search bar glassmorphism (pill) --}}
            <form action="{{ route('jobs.index') }}" method="GET"
                  class="glass-panel pointer-events-auto mb-16 flex w-full max-w-4xl flex-col gap-2 rounded-[2rem] p-2 shadow-xl shadow-blue-200/40 animate-fade-up [animation-delay:240ms] md:flex-row md:p-3">
                <div class="flex flex-1 items-center rounded-full border border-transparent bg-white/50 px-4 py-3 transition-colors focus-within:border-blue-600/30 focus-within:bg-white md:py-0">
                    <span class="material-symbols-outlined mr-3 text-[20px] text-slate-400">search</span>
                    <input name="q" value="{{ request('q') }}" class="w-full border-none bg-transparent px-0 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0" placeholder="Job title, keywords, atau perusahaan">
                </div>
                <div class="mx-2 hidden h-8 w-px self-center bg-slate-300/40 md:block"></div>
                <div class="flex flex-1 items-center rounded-full border border-transparent bg-white/50 px-4 py-3 transition-colors focus-within:border-blue-600/30 focus-within:bg-white md:py-0">
                    <span class="material-symbols-outlined mr-3 text-[20px] text-slate-400">location_on</span>
                    <input name="city" value="{{ request('city') }}" class="w-full border-none bg-transparent px-0 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0" placeholder="Kota, atau Remote">
                </div>
                <button class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-8 py-4 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:brightness-105 active:scale-[0.98] md:py-0">
                    Search Jobs
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            {{-- Stats inline (desktop saja; mobile pakai bento di bawah) --}}
            <div class="hidden w-full max-w-3xl grid-cols-3 gap-8 border-t border-slate-200/60 pt-8 md:grid md:gap-16">
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-extrabold text-slate-950 sm:text-3xl">{{ number_format($stats['jobs']) }}+</span>
                    <span class="mt-1 text-xs font-semibold text-slate-500 sm:text-sm">Lowongan</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-extrabold text-slate-950 sm:text-3xl">{{ number_format($stats['companies']) }}+</span>
                    <span class="mt-1 text-xs font-semibold text-slate-500 sm:text-sm">Perusahaan</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-extrabold text-slate-950 sm:text-3xl">{{ number_format($stats['seekers']) }}+</span>
                    <span class="mt-1 text-xs font-semibold text-slate-500 sm:text-sm">Kandidat</span>
                </div>
            </div>

            {{-- Pill kategori versi mobile --}}
            <div class="mt-10 grid w-full max-w-sm grid-cols-2 gap-2.5 md:hidden">
                @foreach ($heroChips->take(6) as $i => $category)
                    <a href="{{ $category['url'] }}"
                       class="group inline-flex min-h-9 items-center justify-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-center shadow-sm transition hover:border-blue-600 hover:bg-blue-600 active:scale-95">
                        <span class="material-symbols-outlined text-[18px] text-blue-600 group-hover:text-white">{{ $chipIcons[$i] }}</span>
                        <span class="min-w-0 truncate text-xs font-semibold text-slate-600 group-hover:text-white">{{ $category['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================= FEATURED JOBS ========================= --}}
    <section class="bg-white px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div data-reveal class="mb-12 flex items-end justify-between">
                <div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Lowongan Pilihan</h2>
                    <p class="text-sm text-slate-600 sm:text-base">Peluang terbaik dari perusahaan di YourJob.</p>
                </div>
                <a href="{{ route('jobs.index') }}" class="hidden items-center gap-1 text-sm font-bold text-blue-600 transition hover:text-blue-700 md:flex">
                    Lihat semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>

            @if ($latestJobs->isNotEmpty())
                {{-- Mobile: scroll horizontal snap. Desktop: grid. --}}
                <div class="no-scrollbar -mx-4 flex snap-x snap-mandatory gap-4 overflow-x-auto px-4 pb-4 md:mx-0 md:grid md:grid-cols-2 md:gap-6 md:overflow-visible md:px-0 md:pb-0 lg:grid-cols-3">
                    @foreach ($latestJobs->take(6) as $job)
                        <div data-reveal="pop" data-reveal-delay="{{ ($loop->index % 3) * 100 }}" class="w-[280px] shrink-0 snap-start md:w-auto md:shrink">
                            @include('partials.job-card', ['job' => $job])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 py-16 text-center text-slate-500">
                    Belum ada lowongan aktif saat ini.
                </div>
            @endif

            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-1 rounded-full border border-blue-600/20 px-4 py-2 text-sm font-bold text-blue-600 transition hover:bg-blue-50">
                    Lihat semua lowongan <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- =================== STATS BENTO (mobile saja) =================== --}}
    <section class="bg-white px-4 pb-16 md:hidden">
        <div class="grid grid-cols-2 gap-3">
            <div class="glass-card relative flex flex-col items-center justify-center gap-1 overflow-hidden rounded-2xl p-5 text-center">
                <div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-blue-600/10 blur-xl"></div>
                <span class="text-3xl font-extrabold text-blue-600">{{ number_format($stats['jobs']) }}+</span>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lowongan Aktif</span>
            </div>
            <div class="glass-card relative flex flex-col items-center justify-center gap-1 overflow-hidden rounded-2xl p-5 text-center">
                <div class="absolute -bottom-4 -left-4 h-16 w-16 rounded-full bg-violet-accent/10 blur-xl"></div>
                <span class="text-3xl font-extrabold text-violet-accent">{{ number_format($stats['companies']) }}+</span>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Perusahaan</span>
            </div>
            <div class="glass-card col-span-2 flex items-center justify-between rounded-2xl border-l-4 border-l-blue-600 p-5">
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-slate-950">Dapatkan Notifikasi Lowongan</span>
                    <span class="text-sm text-slate-600">Jangan lewatkan peluang baru.</span>
                </div>
                @auth
                    <a href="{{ route('preferences') }}" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-blue-600 shadow-sm transition hover:bg-blue-600 hover:text-white active:scale-95">
                        <span class="material-symbols-outlined text-xl">notifications_active</span>
                    </a>
                @else
                    <button type="button" @click="authModal = 'register'" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-blue-600 shadow-sm transition hover:bg-blue-600 hover:text-white active:scale-95">
                        <span class="material-symbols-outlined text-xl">notifications_active</span>
                    </button>
                @endauth
            </div>
        </div>
    </section>

    {{-- ============================== CTA ============================== --}}
    <section class="px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="relative overflow-hidden rounded-[2rem] border border-blue-200/40 bg-slate-50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/15 via-white to-violet-accent/10 opacity-60"></div>
                <div class="relative z-10 flex flex-col items-center justify-between gap-12 px-8 py-16 text-center md:flex-row md:px-16 md:py-24 md:text-left">
                    <div class="max-w-xl">
                        <h2 data-reveal="pop" class="mb-4 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Mulai Rekrut Hari Ini</h2>
                        <p data-reveal="pop" data-reveal-delay="100" class="mb-8 text-base leading-7 text-slate-600 sm:text-lg">
                            Bergabung dengan perusahaan yang membangun tim impian mereka di YourJob. Pasang lowongan pertamamu gratis.
                        </p>
                        <div class="flex flex-col justify-center gap-4 sm:flex-row md:justify-start">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-8 py-4 text-base font-bold text-white shadow-lg shadow-blue-600/30 transition hover:brightness-105 active:scale-[0.98]">
                                    Pasang Lowongan Gratis
                                </a>
                            @else
                                <button type="button" @click="authModal = 'register'" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-violet-accent px-8 py-4 text-base font-bold text-white shadow-lg shadow-blue-600/30 transition hover:brightness-105 active:scale-[0.98]">
                                    Pasang Lowongan Gratis
                                </button>
                            @endauth
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center rounded-full border border-blue-600/20 bg-white px-8 py-4 text-base font-bold text-blue-600 transition hover:bg-blue-50">
                                Jelajahi Lowongan
                            </a>
                        </div>
                    </div>

                    {{-- Ilustrasi kartu melayang --}}
                    <div class="relative flex w-full justify-center md:w-1/3">
                        <div class="absolute h-64 w-64 rounded-full bg-gradient-to-tr from-blue-600 to-violet-accent opacity-20 blur-3xl"></div>
                        <div class="glass-card relative z-10 flex h-48 w-48 rotate-12 items-center justify-center rounded-2xl border border-white/40 shadow-xl">
                            <span class="material-symbols-outlined text-[80px] text-blue-600" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                        </div>
                        <div class="glass-card absolute bottom-0 left-0 z-20 flex h-32 w-32 -rotate-12 items-center justify-center rounded-2xl border border-white/40 shadow-lg">
                            <span class="material-symbols-outlined text-[48px] text-emerald-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
