@extends('layouts.app', ['title' => 'Cari Perusahaan'])

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
    <div class="mx-auto mb-10 max-w-3xl text-center">
        <h1 class="text-3xl font-extrabold tracking-tight text-[#171c1f] sm:text-5xl">Temukan Perusahaan Impian</h1>
        <p class="mt-4 text-base leading-7 text-[#505f76] sm:text-lg">Eksplorasi perusahaan teknologi terkemuka, startup inovatif, dan korporasi global yang sesuai dengan nilai dan aspirasi karir Anda.</p>
    </div>

    <form method="GET" action="{{ route('employers.index') }}" class="mx-auto mb-10 max-w-4xl rounded-[24px] border border-white/50 bg-white/70 p-3 shadow-sm backdrop-blur-xl md:p-4">
        <div class="flex flex-col gap-3 md:flex-row">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#505f76]">search</span>
                <input name="q" value="{{ request('q') }}" class="w-full rounded-xl border border-[#c7c4d7] bg-white py-3 pl-12 pr-4 text-base text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]" placeholder="Cari nama perusahaan..." type="text">
            </div>
            <select name="industry" class="rounded-xl border border-[#c7c4d7] bg-white px-4 py-3 text-sm font-semibold text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]">
                <option value="">Industri</option>
                @foreach ($industries as $industry)
                    <option value="{{ $industry }}" @selected(request('industry') === $industry)>{{ $industry }}</option>
                @endforeach
            </select>
            <select name="city" class="rounded-xl border border-[#c7c4d7] bg-white px-4 py-3 text-sm font-semibold text-[#171c1f] outline-none transition focus:border-[#4648d4] focus:ring-2 focus:ring-[#e1e0ff]">
                <option value="">Lokasi</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" @selected(request('city') === $city)>{{ $city }}</option>
                @endforeach
            </select>
            <button class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:brightness-105">Cari</button>
        </div>
    </form>

    <div class="mb-8 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-[#171c1f]">Perusahaan Populer</h2>
        <p class="hidden text-sm font-semibold text-[#505f76] md:block">Menampilkan {{ $employers->count() }} dari {{ $employers->total() }} perusahaan</p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        @forelse ($employers as $employer)
            @php
                $logo = $employer->logo;
                $logoUrl = $logo ? (Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset('storage/'.$logo)) : null;
            @endphp
            <article class="flex h-full flex-col rounded-[24px] border border-white/60 bg-white/80 p-6 shadow-[0_10px_20px_-10px_rgba(99,102,241,0.04)] backdrop-blur transition duration-200 hover:-translate-y-1 hover:border-[#c0c1ff] hover:shadow-[0_15px_30px_-10px_rgba(99,102,241,0.12)]">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-xl border border-[#c7c4d7] bg-white text-xl font-extrabold text-[#4648d4] shadow-sm">
                            @if ($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $employer->company_name }}" class="h-full w-full object-cover">
                            @else
                                {{ Str::of($employer->company_name)->substr(0, 1)->upper() }}
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#171c1f]">{{ $employer->company_name }}</h3>
                            <p class="mt-1 flex items-center gap-2 text-sm font-semibold text-[#505f76]"><span class="material-symbols-outlined text-[16px]">domain</span>{{ $employer->industry ?: 'Industri belum diisi' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('employers.show', $employer->publicUsername()) }}" class="rounded-full border border-[#c7c4d7] px-4 py-1.5 text-xs font-bold text-[#4648d4] transition hover:border-[#4648d4] hover:bg-[#e1e0ff]">Follow</a>
                </div>

                <div class="mb-6 mt-2 flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#d3e4fe] px-3 py-1 text-xs font-semibold text-[#0b1c30]"><span class="material-symbols-outlined text-[14px]">location_on</span>{{ $employer->city ?: 'Remote' }}</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#dfe3e7] px-3 py-1 text-xs font-semibold text-[#464554]"><span class="material-symbols-outlined text-[14px]">groups</span>Tim aktif</span>
                </div>

                <div class="mt-auto flex items-center justify-between border-t border-[#c7c4d7]/30 pt-4">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#10b981]"><span class="h-2 w-2 animate-pulse rounded-full bg-[#10b981]"></span>{{ $employer->active_jobs_count }} Lowongan</div>
                    <a class="inline-flex items-center gap-1 text-sm font-bold text-[#4648d4] transition hover:text-[#6b38d4]" href="{{ route('employers.show', $employer->publicUsername()) }}">
                        Kunjungi Profil <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>
        @empty
            <div class="rounded-[24px] border border-white/60 bg-white p-10 text-center shadow-sm lg:col-span-2">
                <h2 class="text-xl font-bold text-[#171c1f]">Belum ada perusahaan yang cocok</h2>
                <p class="mt-2 text-[#505f76]">Coba ubah kata kunci, industri, atau lokasi pencarian.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $employers->links() }}
    </div>
</section>
@endsection
