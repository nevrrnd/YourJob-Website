@extends('layouts.app', ['title' => 'Profil Perusahaan'])

@section('content')
@php
    $logo = $employer->logo;
    $logoUrl = $logo ? (Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset('storage/'.$logo)) : null;
@endphp

<section class="mx-auto w-full max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
    <div class="mb-16 overflow-hidden rounded-[24px] bg-white shadow-[0_10px_20px_rgba(99,102,241,0.04)]">
        <div class="h-48 bg-[radial-gradient(circle_at_20%_20%,#c0c1ff_0,#e9ddff_34%,#f6fafe_70%)] md:h-64"></div>
        <div class="relative px-6 pb-10 pt-4 md:px-10">
            <div class="-mt-16 mb-6 flex flex-col gap-6 md:-mt-20 md:flex-row md:items-end">
                <div class="grid h-32 w-32 shrink-0 place-items-center overflow-hidden rounded-[24px] border-4 border-white bg-white text-5xl font-extrabold text-[#4648d4] shadow-sm md:h-40 md:w-40">
                    @if ($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $employer->company_name }}" class="h-full w-full object-cover">
                    @else
                        {{ Str::of($employer->company_name)->substr(0, 1)->upper() }}
                    @endif
                </div>
                <div class="flex w-full flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <h1 class="text-3xl font-bold text-[#171c1f] md:text-4xl">{{ $employer->company_name }}</h1>
                        <div class="mt-3 flex flex-wrap items-center gap-3 text-base text-[#505f76]">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[20px]">business</span>{{ $employer->industry ?: 'Industri belum diisi' }}</span>
                            <span class="h-1 w-1 rounded-full bg-[#c7c4d7]"></span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[20px]">location_on</span>{{ $employer->city ?: 'Remote' }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('jobs.index', ['q' => $employer->company_name]) }}" class="inline-flex items-center gap-2 rounded-full bg-[#f0f4f8] px-6 py-3 text-sm font-bold text-[#464554] transition hover:bg-[#eaeef2]">
                            <span class="material-symbols-outlined text-[18px]">language</span>
                            Lihat Lowongan
                        </a>
                        <a href="{{ route('employers.index') }}" class="rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 px-8 py-3 text-sm font-bold text-white shadow-[0_4px_10px_rgba(99,102,241,0.2)] transition hover:shadow-lg">
                            Follow
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
        <div class="flex flex-col gap-8 lg:col-span-8">
            <section class="rounded-[24px] bg-white p-6 shadow-[0_10px_20px_rgba(99,102,241,0.04)] md:p-10">
                <h2 class="mb-6 text-2xl font-bold text-[#171c1f]">Tentang {{ $employer->company_name }}</h2>
                <div class="space-y-4 text-lg leading-8 text-[#464554]">
                    <p>{{ $employer->description ?: 'Perusahaan ini belum menambahkan deskripsi lengkap. Anda tetap bisa melihat lowongan aktif dan menghubungi perusahaan melalui proses lamaran di YourJob.' }}</p>
                </div>
            </section>

            <section>
                <h2 class="mb-6 flex items-center gap-2 text-2xl font-bold text-[#171c1f]"><span class="material-symbols-outlined text-[#4648d4]">work</span>Lowongan Terbuka</h2>
                <div class="space-y-4">
                    @forelse ($jobs as $job)
                        <article class="group flex flex-col justify-between gap-6 rounded-[24px] border border-transparent bg-white p-6 shadow-[0_10px_20px_rgba(99,102,241,0.04)] transition duration-300 hover:-translate-y-1 hover:border-[#c0c1ff] md:flex-row md:items-center">
                            <div class="flex-grow">
                                <div class="mb-3 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-[#10b981]"><span class="material-symbols-outlined text-[14px]">fiber_new</span>New</span>
                                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-[#4648d4]">{{ $job->location_label }}</span>
                                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-[#4648d4]">{{ $job->type_label }}</span>
                                </div>
                                <h3 class="text-2xl font-bold text-[#171c1f]">{{ $job->title }}</h3>
                                <div class="mt-2 flex flex-wrap items-center gap-4 text-base text-[#505f76]">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">location_on</span>{{ $job->city ?: $job->location_label }}</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">payments</span>{{ $job->salary_range }}</span>
                                </div>
                            </div>
                            <div class="shrink-0">
                                <a href="{{ route('jobs.show', $job) }}" class="inline-flex w-full justify-center rounded-full bg-[#f0f4f8] px-6 py-3 text-sm font-bold text-[#171c1f] transition hover:bg-[#4648d4] hover:text-white md:w-auto">Lamar Sekarang</a>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] bg-white p-8 text-center shadow-[0_10px_20px_rgba(99,102,241,0.04)]">
                            <h3 class="text-xl font-bold text-[#171c1f]">Belum ada lowongan terbuka</h3>
                            <p class="mt-2 text-[#505f76]">Cek lagi nanti untuk peluang baru dari perusahaan ini.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <aside class="lg:col-span-4">
            <div class="sticky top-28 rounded-[24px] border border-white/50 bg-white/70 p-6 backdrop-blur-xl">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-[#505f76]">Informasi Perusahaan</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined mt-0.5 text-[#4648d4]">business</span>
                        <div>
                            <p class="text-sm font-bold text-[#171c1f]">Ukuran Perusahaan</p>
                            <p class="text-base text-[#464554]">Tim aktif di YourJob</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined mt-0.5 text-[#4648d4]">work</span>
                        <div>
                            <p class="text-sm font-bold text-[#171c1f]">Lowongan Aktif</p>
                            <p class="text-base text-[#464554]">{{ $jobs->count() }} posisi</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined mt-0.5 text-[#4648d4]">verified</span>
                        <div>
                            <p class="text-sm font-bold text-[#171c1f]">Status</p>
                            <p class="text-base text-[#464554]">{{ $employer->is_verified ? 'Terverifikasi' : 'Belum diverifikasi' }}</p>
                        </div>
                    </li>
                </ul>

                <hr class="my-6 border-[#c7c4d7]">

                <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-[#505f76]">Benefit Utama</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="rounded-full border border-[#c7c4d7]/30 bg-white px-3 py-1.5 text-xs font-semibold text-[#464554] shadow-sm">Lingkungan Kolaboratif</span>
                    <span class="rounded-full border border-[#c7c4d7]/30 bg-white px-3 py-1.5 text-xs font-semibold text-[#464554] shadow-sm">Pengembangan Karir</span>
                    <span class="rounded-full border border-[#c7c4d7]/30 bg-white px-3 py-1.5 text-xs font-semibold text-[#464554] shadow-sm">Proses Rekrutmen Online</span>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
