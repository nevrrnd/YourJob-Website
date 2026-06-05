@php
    $company = $job->employer?->companyProfile;
    $logo = $company?->logo ? asset('storage/' . $company->logo) : null;
@endphp

<article class="group rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1.5 hover:shadow-lg sm:p-6">
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <h3 class="text-lg font-semibold text-slate-950">
                <a href="{{ route('jobs.show', $job) }}" class="line-clamp-2 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/30">{{ $job->title }}</a>
            </h3>
            <p class="mt-1 truncate text-sm text-slate-600">{{ $company?->company_name ?? $job->employer?->name }} - {{ $job->location_label }}</p>
        </div>
        @auth
            @if (auth()->user()->isSeeker())
                <form action="{{ route('seeker.save', $job) }}" method="POST">
                    @csrf
                    <button class="rounded-full px-3 py-2 text-sm font-semibold text-slate-400 transition hover:text-red-500" aria-label="Save job">♡</button>
                </form>
            @endif
        @endauth
    </div>

    <div class="mt-4 space-y-3 text-sm text-slate-700">
        <p class="line-clamp-3">{{ Str::limit(strip_tags($job->description), 140) }}</p>
        <div class="flex flex-wrap gap-2">
            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">{{ $job->type_label }}</span>
            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">{{ $job->experience_label }}</span>
            @if ($job->salary_range)
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">{{ $job->salary_range }}</span>
            @endif
        </div>
    </div>

    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-xs">
        <span class="text-slate-400">{{ $job->created_at?->diffForHumans() }}</span>
        <a href="{{ route('jobs.show', $job) }}" class="font-bold text-blue-600 hover:underline">
            Detail
        </a>
    </div>
</article>
