@php
    $company = $job->employer?->companyProfile;
    $logo = $company?->logo ? asset('storage/' . $company->logo) : null;
    $companyName = $company?->company_name ?? $job->employer?->name;
@endphp

<article class="glass-card group flex h-full flex-col rounded-2xl p-6 ring-1 ring-slate-200/60">
    <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-xl border border-slate-200/60 bg-slate-100">
            @if ($logo)
                <img src="{{ $logo }}" alt="{{ $companyName }}" class="h-full w-full object-cover">
            @else
                <span class="material-symbols-outlined text-[24px] text-blue-600">business</span>
            @endif
        </div>
        @auth
            @if (auth()->user()->isSeeker())
                <form action="{{ route('seeker.save', $job) }}" method="POST">
                    @csrf
                    <button class="rounded-full p-2 text-slate-300 transition hover:bg-red-50 hover:text-red-500" aria-label="Simpan lowongan">
                        <span class="material-symbols-outlined text-[22px]">favorite</span>
                    </button>
                </form>
            @endif
        @endauth
    </div>

    <h3 class="mb-1 text-lg font-bold text-slate-950 transition-colors group-hover:text-blue-600">
        <a href="{{ route('jobs.show', $job) }}" class="line-clamp-2 focus:outline-none focus:ring-2 focus:ring-blue-600/30">{{ $job->title }}</a>
    </h3>
    <p class="mb-4 truncate text-sm text-slate-600">{{ $companyName }} • {{ $job->location_label }}</p>

    <div class="mb-6 flex flex-wrap gap-2">
        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> {{ $job->type_label }}
        </span>
        <span class="rounded-full border border-slate-200/60 bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">{{ $job->experience_label }}</span>
        @if ($job->salary_range)
            <span class="rounded-full border border-slate-200/60 bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">{{ $job->salary_range }}</span>
        @endif
    </div>

    <div class="mt-auto flex items-center justify-between border-t border-slate-200/60 pt-4">
        <span class="text-xs font-medium text-slate-400">{{ $job->created_at?->diffForHumans() }}</span>
        <a href="{{ route('jobs.show', $job) }}" class="text-sm font-bold text-blue-600 transition group-hover:underline">
            Lihat Detail
        </a>
    </div>
</article>
