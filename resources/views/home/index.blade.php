@extends('layouts.app', ['title' => 'YourJob'])

@section('content')
@php
    // Preset posisi + gaya kedalaman untuk floating chips kategori.
    // 'show' diatur per-breakpoint agar responsif: 2 chip teratas tampil di HP (zona aman atas),
    // sisanya bertambah seiring layar membesar.
    $chipStyles = [
        ['pos' => 'top-[7%] left-[6%]',    'depth' => '',                        'speed' => 1.5, 'show' => 'flex',           'accent' => false],
        ['pos' => 'top-[7%] right-[6%]',   'depth' => '',                        'speed' => 1.2, 'show' => 'flex',           'accent' => true],
        ['pos' => 'top-[21%] left-[13%]',  'depth' => 'opacity-90',              'speed' => 2.0, 'show' => 'hidden sm:flex', 'accent' => false],
        ['pos' => 'top-[27%] right-[15%]', 'depth' => 'opacity-90',              'speed' => 1.8, 'show' => 'hidden sm:flex', 'accent' => false],
        ['pos' => 'top-[47%] left-[5%]',   'depth' => 'blur-[1px] opacity-70',   'speed' => 0.8, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[53%] right-[6%]',  'depth' => '',                        'speed' => 1.1, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[72%] left-[11%]',  'depth' => '',                        'speed' => 1.4, 'show' => 'hidden md:flex', 'accent' => false],
        ['pos' => 'top-[78%] right-[13%]', 'depth' => 'opacity-80',              'speed' => 0.7, 'show' => 'hidden md:flex', 'accent' => false],
        ['pos' => 'top-[88%] left-[30%]',  'depth' => 'blur-[1px] opacity-60',   'speed' => 0.6, 'show' => 'hidden lg:flex', 'accent' => false],
        ['pos' => 'top-[16%] right-[30%]', 'depth' => 'blur-[0.5px] opacity-70', 'speed' => 0.9, 'show' => 'hidden xl:flex', 'accent' => false],
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
    <section class="parallax-wrapper relative flex min-h-[calc(100vh-4rem)] items-center overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-slate-50 px-4 py-16 sm:px-6 lg:px-8">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-grid-faint [background-size:44px_44px] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_0%,black,transparent)]"></div>
            <div class="absolute -left-20 -top-10 h-80 w-80 rounded-full bg-blue-400/30 blur-3xl animate-blob sm:h-[28rem] sm:w-[28rem]"></div>
            <div class="absolute right-0 top-16 h-80 w-80 rounded-full bg-violet-400/25 blur-3xl animate-blob-slow [animation-delay:-4s] sm:h-[26rem] sm:w-[26rem]"></div>
        </div>

        {{-- Floating chips kategori (DESKTOP): melayang + parallax, bisa diklik --}}
        <div id="chip-container" class="pointer-events-none absolute inset-0 z-0 hidden md:block">
            @foreach ($heroChips as $i => $category)
                @php $s = $chipStyles[$i]; @endphp
                <a href="{{ $category['url'] }}"
                   data-speed="{{ $s['speed'] }}"
                   title="Lihat lowongan {{ $category['name'] }}"
                   class="chip group pointer-events-auto absolute {{ $s['pos'] }} {{ $s['show'] }} items-center gap-2 rounded-full border px-5 py-2.5 shadow-sm {{ $s['depth'] }} hover:z-20 hover:opacity-100 hover:shadow-lg hover:blur-none {{ $s['accent'] ? 'border-red-200 bg-red-50 hover:border-red-600 hover:bg-red-600 hover:shadow-red-600/30' : 'border-slate-200 bg-white hover:border-blue-600 hover:bg-blue-600 hover:shadow-blue-600/30' }}">
                    <span class="material-symbols-outlined text-[20px] {{ $s['accent'] ? 'text-red-500' : 'text-blue-600' }} group-hover:text-white">{{ $chipIcons[$i] }}</span>
                    <span class="whitespace-nowrap text-sm font-semibold {{ $s['accent'] ? 'text-red-700' : 'text-slate-600' }} group-hover:text-white">{{ $category['name'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- Hero content (tanpa card) --}}
        <div class="pointer-events-none relative z-10 mx-auto w-full max-w-3xl space-y-8 text-center">
            <div class="space-y-4">
                <h1 class="animate-fade-up text-balance text-3xl font-extrabold leading-tight tracking-tight text-slate-950 [animation-delay:80ms] sm:text-5xl lg:text-6xl">
                    Temukan karier berikutnya dengan <span class="text-blue-600">momentum</span> yang tepat.
                </h1>
                <p class="mx-auto max-w-xl animate-fade-up text-balance text-base leading-7 text-slate-600 [animation-delay:160ms] sm:text-lg">
                    Jelajahi lowongan pilihan, simpan pekerjaan favorit, dan kirim lamaran dari satu tempat yang rapi.
                </p>
            </div>

            <form action="{{ route('jobs.index') }}" method="GET" class="pointer-events-auto grid animate-fade-up gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-blue-200/40 [animation-delay:240ms] md:grid-cols-[1fr_1fr_auto]">
                <div class="relative flex items-center rounded-xl bg-slate-50 px-3">
                    <span class="material-symbols-outlined pointer-events-none text-[20px] text-slate-400">search</span>
                    <input name="q" value="{{ request('q') }}" class="min-h-12 w-full border-none bg-transparent px-2 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0" placeholder="Job title, company, keyword">
                </div>
                <div class="relative flex items-center rounded-xl bg-slate-50 px-3">
                    <span class="material-symbols-outlined pointer-events-none text-[20px] text-slate-400">location_on</span>
                    <input name="city" value="{{ request('city') }}" class="min-h-12 w-full border-none bg-transparent px-2 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0" placeholder="City or Remote">
                </div>
                <button class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700 active:scale-[0.98]">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                    Find Jobs
                </button>
            </form>

            {{-- Chips kategori (MOBILE): deretan pill ke tengah yang wrap (gaya wellfound) --}}
            @if ($heroChips->isNotEmpty())
                <div class="pointer-events-auto flex animate-fade-up flex-wrap justify-center gap-2.5 [animation-delay:320ms] md:hidden">
                    @foreach ($heroChips as $i => $category)
                        <a href="{{ $category['url'] }}"
                           class="group inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 shadow-sm transition hover:border-blue-600 hover:bg-blue-600 hover:shadow-md {{ $i >= 6 ? 'opacity-60' : '' }}">
                            <span class="material-symbols-outlined text-[18px] text-blue-600 group-hover:text-white">{{ $chipIcons[$i] }}</span>
                            <span class="whitespace-nowrap text-sm font-semibold text-slate-600 group-hover:text-white">{{ $category['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Browse Categories: Roles (real) / Locations / Industries --}}
    <section class="border-t border-slate-200 bg-gradient-to-b from-white via-slate-50/60 to-white px-4 py-14 sm:py-20">
        <div class="mx-auto max-w-7xl">
            <h2 class="mb-10 text-center text-2xl font-bold tracking-tight text-slate-950 sm:mb-12 sm:text-3xl">Temukan pekerjaan yang tepat</h2>
            <div class="grid grid-cols-1 gap-10 md:grid-cols-3 md:gap-12">
                @php
                    $browseColumns = [
                        ['title' => 'Roles', 'items' => $categories->take(6)->map(fn ($c) => ['label' => $c->name, 'url' => route('jobs.index', ['category' => $c->id])])->all()],
                        ['title' => 'Lokasi', 'items' => collect(['Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Remote'])->map(fn ($city) => ['label' => $city, 'url' => route('jobs.index', ['city' => $city])])->all()],
                        ['title' => 'Industri', 'items' => collect(['AI', 'Web3', 'E-commerce', 'SaaS', 'Fintech'])->map(fn ($ind) => ['label' => $ind, 'url' => route('jobs.index', ['q' => $ind])])->all()],
                    ];
                @endphp
                @foreach ($browseColumns as $column)
                    <div>
                        <h3 class="mb-6 border-b border-slate-200 pb-2 text-sm font-semibold uppercase tracking-widest text-slate-500">{{ $column['title'] }}</h3>
                        <ul class="space-y-3 text-slate-800">
                            @forelse ($column['items'] as $item)
                                <li>
                                    <a href="{{ $item['url'] }}" class="group flex items-center justify-between transition-colors hover:text-blue-600">
                                        {{ $item['label'] }}
                                        <span class="material-symbols-outlined text-[18px] opacity-0 transition-opacity group-hover:opacity-100">arrow_outward</span>
                                    </a>
                                </li>
                            @empty
                                <li class="text-sm text-slate-400">Belum ada data.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stats: gradasi tipis, angka biru, data asli --}}
    <section class="border-t border-slate-200 bg-gradient-to-br from-blue-50/50 via-white to-violet-50/40 py-14 sm:py-16">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 divide-y divide-slate-200 px-4 text-center sm:px-6 md:grid-cols-3 md:divide-x md:divide-y-0 lg:px-8">
            <div class="py-4">
                <div class="text-4xl font-extrabold text-blue-600 sm:text-5xl">{{ number_format($stats['jobs']) }}+</div>
                <p class="mt-2 text-sm font-medium text-slate-500">Active jobs</p>
            </div>
            <div class="py-4">
                <div class="text-4xl font-extrabold text-blue-600 sm:text-5xl">{{ number_format($stats['companies']) }}</div>
                <p class="mt-2 text-sm font-medium text-slate-500">Companies</p>
            </div>
            <div class="py-4">
                <div class="text-4xl font-extrabold text-blue-600 sm:text-5xl">{{ number_format($stats['seekers']) }}</div>
                <p class="mt-2 text-sm font-medium text-slate-500">Simple profiles</p>
            </div>
        </div>
    </section>

    {{-- Company logos strip (placeholder) --}}
    <section class="bg-gradient-to-b from-slate-50 via-white to-slate-50 px-4 py-14 sm:py-20">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="mb-10 text-xl font-bold text-slate-500">Perusahaan yang sudah bergabung</h2>
            <div class="grid grid-cols-3 items-center justify-items-center gap-8 md:grid-cols-4 lg:grid-cols-6">
                @foreach ([
                    ['rocket_launch', 'Acme'], ['code_blocks', 'DevCo'], ['payments', 'FinStart'],
                    ['shopping_bag', 'ShopAI'], ['health_and_safety', 'MedTech'], ['eco', 'GreenEnergy'],
                    ['public', 'GlobalNet'], ['auto_awesome', 'CreativeSy'], ['database', 'DataCore'],
                    ['shield', 'SecureIT'], ['architecture', 'BuildPro'], ['psychology', 'MindAI'],
                ] as $i => [$icon, $name])
                    <div class="flex items-center gap-2 text-xl font-bold text-slate-800 opacity-50 grayscale transition-all duration-300 hover:opacity-100 hover:grayscale-0 {{ $i >= 6 ? 'hidden md:flex' : '' }}">
                        <span class="material-symbols-outlined text-blue-600">{{ $icon }}</span> {{ $name }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Dual value prop (bento) --}}
    <section class="border-t border-slate-200 bg-slate-50 px-4 py-14 sm:py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">
            @php
                $bento = [
                    [
                        'eyebrow' => 'Untuk Pencari Kerja', 'title' => 'Temukan tempat dimana kamu dihargai.', 'accent' => false,
                        'features' => [
                            ['handshake', 'Koneksi Langsung', 'Terhubung langsung dengan hiring manager. Tanpa perantara.'],
                            ['visibility', 'Transparansi Penuh', 'Lihat lokasi, tipe kerja, dan estimasi gaji sebelum apply.'],
                            ['bolt', 'Apply Mudah', 'Satu profil tersimpan untuk apply ke banyak lowongan dengan cepat.'],
                            ['star', 'Pekerjaan Relevan', 'Filter dan pencarian membantu kamu fokus ke role yang cocok.'],
                        ],
                    ],
                    [
                        'eyebrow' => 'Untuk Perusahaan', 'title' => 'Bangun tim solid lebih cepat.', 'accent' => true,
                        'features' => [
                            ['group', 'Akses Talenta', 'Jangkau pencari kerja aktif dari satu platform yang rapi.'],
                            ['speed', 'Setup Cepat', 'Posting lowongan dalam hitungan menit dan mulai terima pelamar.'],
                            ['view_kanban', 'Pipeline Sederhana', 'Pantau lamaran masuk dari dashboard yang ringkas.'],
                            ['smart_toy', 'Brand Rapi', 'Lowongan tampil modern dan konsisten di semua layar.'],
                        ],
                    ],
                ];
            @endphp
            @foreach ($bento as $card)
                <div class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="mb-8 border-b border-slate-200 pb-6">
                        <span class="mb-4 inline-block rounded-full {{ $card['accent'] ? 'bg-slate-100 text-slate-700' : 'bg-blue-50 text-blue-700' }} px-3 py-1 text-sm font-semibold">{{ $card['eyebrow'] }}</span>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">{{ $card['title'] }}</h2>
                    </div>
                    <div class="grid flex-grow grid-cols-1 gap-6 sm:grid-cols-2">
                        @foreach ($card['features'] as [$icon, $featTitle, $featDesc])
                            <div class="flex flex-col gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['accent'] ? 'bg-slate-100 text-slate-700' : 'bg-blue-50 text-blue-600' }}">
                                    <span class="material-symbols-outlined">{{ $icon }}</span>
                                </div>
                                <h3 class="font-semibold text-slate-950">{{ $featTitle }}</h3>
                                <p class="text-sm leading-6 text-slate-600">{{ $featDesc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Featured jobs (data asli) --}}
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

    {{-- Bottom CTA --}}
    <section class="bg-slate-900 px-4 py-20 text-center text-white">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">Siap Memulai?</h2>
            <p class="mx-auto mt-4 max-w-xl text-base text-slate-300 sm:text-lg">
                Bergabunglah dengan talenta dan perusahaan lainnya di YourJob hari ini.
            </p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-8 py-4 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700">
                    Cari Pekerjaan Sekarang
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl border border-white/30 bg-transparent px-8 py-4 text-sm font-bold text-white transition hover:bg-white/10">
                        Post Pekerjaan
                    </a>
                @else
                    <button type="button" @click="authModal = 'register'" class="inline-flex items-center justify-center rounded-xl border border-white/30 bg-transparent px-8 py-4 text-sm font-bold text-white transition hover:bg-white/10">
                        Post Pekerjaan
                    </button>
                @endauth
            </div>
        </div>
    </section>
</div>
@endsection
