@extends('layouts.app', ['title' => 'Temukan Talenta Terbaik'])

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-20">
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#171c1f] sm:text-5xl">Temukan Talenta Terbaik</h1>
            <p class="mt-3 max-w-2xl text-base leading-7 text-[#464554] sm:text-lg">Jelajahi kandidat unggulan yang siap bergabung dengan tim Anda.</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="inline-flex w-max items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:shadow-lg">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Post New Job
        </a>
    </div>

    <form method="GET" action="{{ route('seekers.index') }}" class="mb-8 rounded-xl border border-white/50 bg-white/70 p-4 shadow-[0_10px_20px_-5px_rgba(99,102,241,0.04)] backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#505f76]">search</span>
                <input name="q" value="{{ request('q') }}" class="w-full rounded-lg border border-[#c7c4d7] bg-white py-3 pl-12 pr-4 text-base text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]" placeholder="Cari posisi, nama, atau keahlian..." type="text">
            </div>
            <div class="grid gap-4 sm:grid-cols-3 lg:w-auto">
                <select name="skill" class="rounded-lg border border-[#c7c4d7] bg-white px-4 py-3 text-base text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]">
                    <option value="">Semua Keahlian</option>
                    @foreach ($skills as $skill)
                        <option value="{{ $skill }}" @selected(request('skill') === $skill)>{{ $skill }}</option>
                    @endforeach
                </select>
                <select name="city" class="rounded-lg border border-[#c7c4d7] bg-white px-4 py-3 text-base text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]">
                    <option value="">Semua Lokasi</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" @selected(request('city') === $city)>{{ $city }}</option>
                    @endforeach
                </select>
                <button class="inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-500 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-500/20 transition hover:brightness-105">
                    <span class="material-symbols-outlined text-[20px]">search_check</span>
                    Cari
                </button>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($seekers as $seeker)
            @php
                $profile = $seeker->seekerProfile;
                $profileSkills = collect($profile?->skills ?? [])->filter()->values();
                $primarySkill = $profileSkills->first();
                $avatar = $profile?->avatar;
                $avatarUrl = $avatar ? (Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/'.$avatar)) : null;
                $role = $primarySkill ? $primarySkill.' Talent' : 'Professional Talent';
            @endphp
            <article class="group relative flex h-full flex-col overflow-hidden rounded-xl border border-transparent bg-white p-6 shadow-[0_10px_20px_-5px_rgba(99,102,241,0.04)] transition duration-300 hover:-translate-y-1 hover:border-[#e1e0ff]">
                <div class="absolute left-0 top-0 h-1 w-full bg-[#c0c1ff] opacity-0 transition group-hover:opacity-100"></div>
                <a href="{{ route('seekers.show', $seeker->publicUsername()) }}" class="flex items-start gap-4">
                    <div class="relative shrink-0">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ $seeker->name }}" class="h-16 w-16 rounded-full border-2 border-white object-cover shadow-sm">
                        @else
                            <div class="grid h-16 w-16 place-items-center rounded-full border-2 border-white bg-[#e1e0ff] text-xl font-extrabold text-[#2f2ebe] shadow-sm">{{ Str::of($seeker->name)->substr(0, 1)->upper() }}</div>
                        @endif
                        <span class="absolute bottom-0 right-0 h-4 w-4 rounded-full border-2 border-white bg-[#10b981]" title="Open to Work"></span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold leading-tight text-[#171c1f] transition group-hover:text-[#4648d4]">{{ $seeker->name }}</h2>
                        <p class="mt-1 text-base text-[#464554]">{{ $role }}</p>
                    </div>
                </a>

                <div class="mt-5 flex flex-wrap gap-4 text-xs font-semibold text-[#505f76]">
                    <span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">location_on</span>{{ $profile?->city ?: 'Remote' }}</span>
                    <span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">work_history</span>Open Talent</span>
                </div>

                <div class="mt-5 flex flex-wrap gap-2">
                    @forelse ($profileSkills->take(3) as $skill)
                        <span class="rounded-full border border-[#c7c4d7]/40 bg-[#eaeef2] px-3 py-1 text-xs font-semibold text-[#464554]">{{ $skill }}</span>
                    @empty
                        <span class="rounded-full border border-[#c7c4d7]/40 bg-[#eaeef2] px-3 py-1 text-xs font-semibold text-[#464554]">Siap belajar</span>
                    @endforelse
                </div>

                <div class="mt-auto flex items-center justify-between border-t border-[#c7c4d7]/30 pt-5">
                    <span class="inline-flex items-center gap-1.5 rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold text-[#10b981]">Tersedia Segera</span>
                    <a href="{{ route('seekers.show', $seeker->publicUsername()) }}" class="grid h-9 w-9 place-items-center rounded-full text-[#505f76] transition hover:bg-[#e1e0ff]/60 hover:text-[#4648d4]" aria-label="Lihat profil {{ $seeker->name }}">
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-white/50 bg-white p-10 text-center shadow-sm">
                <h2 class="text-xl font-bold text-[#171c1f]">Belum ada kandidat yang cocok</h2>
                <p class="mt-2 text-[#464554]">Coba ubah kata kunci, keahlian, atau lokasi pencarian.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $seekers->links() }}
    </div>
</section>
@endsection
