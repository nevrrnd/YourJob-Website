@extends('layouts.app', ['title' => 'Profil Kandidat'])

@section('content')
@php
    $profile = $seeker->seekerProfile;
    $skills = collect($profile?->skills ?? [])->filter()->values();
    $avatar = $profile?->avatar;
    $avatarUrl = $avatar ? (Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/'.$avatar)) : null;
    $role = $skills->first() ? $skills->first().' Talent' : 'Professional Talent';
@endphp

<section class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-6 px-4 py-10 sm:px-6 lg:grid-cols-12 lg:px-8 lg:py-16">
    <aside class="lg:col-span-4">
        <div class="sticky top-24 overflow-hidden rounded-xl border border-white bg-white p-8 text-center shadow-[0_10px_20px_rgba(99,102,241,0.04)]">
            <div class="pointer-events-none absolute left-1/2 top-0 h-32 w-full -translate-x-1/2 rounded-full bg-[#4648d4]/5 blur-2xl"></div>
            <div class="relative mx-auto mb-6 h-32 w-32">
                @if ($avatarUrl)
                    <img src="{{ $avatarUrl }}" alt="{{ $seeker->name }}" class="relative z-10 h-full w-full rounded-full border-4 border-white object-cover shadow-sm transition duration-300 hover:-translate-y-1">
                @else
                    <div class="relative z-10 grid h-full w-full place-items-center rounded-full border-4 border-white bg-[#e1e0ff] text-5xl font-extrabold text-[#2f2ebe] shadow-sm">{{ Str::of($seeker->name)->substr(0, 1)->upper() }}</div>
                @endif
                <span class="absolute bottom-1 right-1 z-20 grid h-6 w-6 place-items-center rounded-full bg-white shadow-sm">
                    <span class="h-4 w-4 animate-pulse rounded-full bg-[#10b981]"></span>
                </span>
            </div>

            <h1 class="text-3xl font-bold text-[#171c1f]">{{ $seeker->name }}</h1>
            <p class="mt-2 text-xl text-[#464554]">{{ $role }}</p>

            <div class="mt-6 flex flex-col gap-3 border-t border-[#c7c4d7]/30 pt-6 text-left text-[#464554]">
                <span class="flex items-center gap-3"><span class="material-symbols-outlined text-[#767586]">location_on</span>{{ $profile?->city ?: 'Indonesia' }}</span>
                <span class="flex items-center gap-3"><span class="material-symbols-outlined text-[#767586]">payments</span>Negotiable</span>
                <span class="flex items-center gap-3"><span class="material-symbols-outlined text-[#767586]">work_history</span>Portfolio siap ditinjau</span>
            </div>

            <div class="mt-8 flex flex-col gap-4">
                <span class="mx-auto inline-flex w-max items-center justify-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-sm font-bold text-[#10b981]">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    Tersedia Sekarang
                </span>
                <a href="mailto:{{ $seeker->email }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 px-6 py-4 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <span class="material-symbols-outlined">mail</span>
                    Hubungi Kandidat
                </a>
                @if ($profile?->cv_file)
                    <a href="{{ asset('storage/'.$profile->cv_file) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#f0f4f8] px-6 py-3 text-sm font-bold text-[#4648d4] transition hover:bg-[#eaeef2]">
                        <span class="material-symbols-outlined">download</span>
                        Unduh CV
                    </a>
                @endif
            </div>
        </div>
    </aside>

    <div class="flex flex-col gap-8 lg:col-span-8">
        <section class="rounded-xl border border-white bg-white p-8 shadow-[0_10px_20px_rgba(99,102,241,0.04)] lg:p-10">
            <h2 class="mb-4 flex items-center gap-2 text-2xl font-bold text-[#171c1f]"><span class="material-symbols-outlined text-[#4648d4]">person</span>Tentang Saya</h2>
            <p class="text-lg leading-8 text-[#464554]">{{ $profile?->bio ?: 'Kandidat ini belum menambahkan ringkasan profil. Gunakan tombol kontak untuk mengenal kandidat lebih lanjut.' }}</p>
        </section>

        <section class="rounded-xl border border-white bg-white p-8 shadow-[0_10px_20px_rgba(99,102,241,0.04)] lg:p-10">
            <h2 class="mb-6 flex items-center gap-2 text-2xl font-bold text-[#171c1f]"><span class="material-symbols-outlined text-[#4648d4]">psychology</span>Keahlian Utama</h2>
            <div class="flex flex-wrap gap-3">
                @forelse ($skills as $skill)
                    <span class="rounded-full border border-[#c7c4d7]/20 bg-[#f0f4f8] px-5 py-2.5 text-sm font-bold text-[#171c1f] transition hover:border-[#4648d4]/50 hover:bg-[#4648d4]/5">{{ $skill }}</span>
                @empty
                    <span class="rounded-full border border-[#c7c4d7]/20 bg-[#f0f4f8] px-5 py-2.5 text-sm font-bold text-[#171c1f]">Belum ada keahlian</span>
                @endforelse
            </div>
        </section>

        <section class="rounded-xl border border-white bg-white p-8 shadow-[0_10px_20px_rgba(99,102,241,0.04)] lg:p-10">
            <h2 class="mb-8 flex items-center gap-2 text-2xl font-bold text-[#171c1f]"><span class="material-symbols-outlined text-[#4648d4]">work</span>Pengalaman Kerja</h2>
            <div class="relative ml-4 flex flex-col gap-8 border-l-2 border-[#eaeef2] md:ml-6">
                @forelse ($applications as $application)
                    @php
                        $job = $application->job;
                        $company = $job?->employer?->companyProfile;
                    @endphp
                    <div class="group relative pl-8 md:pl-12">
                        <span class="absolute -left-[9px] top-1 h-4 w-4 rounded-full border-4 border-white bg-[#4648d4] transition group-hover:scale-125"></span>
                        <div class="flex flex-col justify-between gap-3 md:flex-row md:items-center">
                            <div>
                                <h3 class="text-lg font-bold text-[#171c1f]">{{ $company?->company_name ?: 'Perusahaan' }}</h3>
                                <p class="font-semibold text-[#4648d4]">{{ $job?->title ?: 'Posisi belum tersedia' }}</p>
                            </div>
                            <span class="w-max rounded-full bg-[#f0f4f8] px-3 py-1 text-xs font-semibold text-[#464554]">{{ $application->created_at?->format('M Y') }}</span>
                        </div>
                        <p class="mt-4 text-[#464554]">Riwayat minat kandidat pada posisi ini tercatat di platform YourJob.</p>
                    </div>
                @empty
                    <div class="group relative pl-8 md:pl-12">
                        <span class="absolute -left-[9px] top-1 h-4 w-4 rounded-full border-4 border-white bg-[#c7c4d7]"></span>
                        <h3 class="text-lg font-bold text-[#171c1f]">Belum ada riwayat lamaran publik</h3>
                        <p class="mt-2 text-[#464554]">Profil ini tetap bisa dihubungi untuk peluang kerja yang relevan.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="rounded-xl border border-white bg-white p-8 shadow-[0_10px_20px_rgba(99,102,241,0.04)] lg:p-10">
            <h2 class="mb-6 flex items-center gap-2 text-2xl font-bold text-[#171c1f]"><span class="material-symbols-outlined text-[#4648d4]">school</span>Pendidikan</h2>
            <div class="flex items-start gap-4 rounded-xl border border-transparent p-4 transition hover:border-[#c7c4d7]/20 hover:bg-[#f0f4f8]">
                <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-[#d0bcff]/20 text-[#6b38d4]">
                    <span class="material-symbols-outlined">account_balance</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-[#171c1f]">Informasi pendidikan belum diisi</h3>
                    <p class="mt-1 text-[#464554]">Detail pendidikan bisa ditambahkan saat kandidat memperbarui profil.</p>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
