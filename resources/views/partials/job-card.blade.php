@php
    $company = $job->employer?->companyProfile;
    $logo = $company?->logo ? asset('storage/' . $company->logo) : null;
@endphp

<div class="group card card-hover p-6 flex flex-col">
    <div class="flex items-start gap-4">
        <div class="grid place-items-center w-14 h-14 rounded-2xl bg-white ring-1 ring-brand-100 overflow-hidden shrink-0 shadow-soft group-hover:scale-105 transition">
            @if ($logo)
                <img src="{{ $logo }}" alt="logo" class="w-full h-full object-cover">
            @else
                <span class="text-2xl">{{ $job->category?->icon ?? 'JOB' }}</span>
            @endif
        </div>
        <div class="min-w-0 flex-1">
            <a href="{{ route('jobs.show', $job) }}" class="block font-bold text-ink-900 group-hover:text-[#2c7da0] transition leading-snug line-clamp-2">{{ $job->title }}</a>
            <p class="text-sm text-[#2c7da0] font-semibold truncate mt-1">{{ $company?->company_name ?? $job->employer?->name }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mt-4">
        <span class="chip-brand">{{ $job->type_label }}</span>
        <span class="chip">{{ $job->location_label }}</span>
        <span class="chip">{{ $job->experience_label }}</span>
    </div>

    <div class="mt-4 flex items-center gap-2 text-sm">
        <span class="font-extrabold text-[#155e75]">{{ $job->salary_range }}</span>
    </div>
    <p class="mt-1 text-sm text-ink-500">{{ $job->city ?? 'Lokasi fleksibel' }}</p>

    <div class="mt-4 pt-4 border-t border-ink-100 flex items-center justify-between text-xs">
        <span class="text-ink-400">{{ $job->created_at?->diffForHumans() }}</span>
        <a href="{{ route('jobs.show', $job) }}" class="font-semibold text-[#1e4a6e] group-hover:gap-1.5 inline-flex items-center gap-1 transition-all">Lihat detail <span aria-hidden="true">&rarr;</span></a>
    </div>
</div>
