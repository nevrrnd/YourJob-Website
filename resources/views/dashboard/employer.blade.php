@extends('layouts.dashboard', ['title' => 'Employer Dashboard', 'hidePageHeader' => true])

@php
    $user = auth()->user();
    $company = $user->companyProfile;
    $canPostJob = (bool) $company?->is_verified;
    $postRoute = $canPostJob ? route('employer.lowongan.create') : route('employer.profile');
    $trendIsUp = $applicationTrend >= 0;
    $statusMeta = [
        'pending' => ['label' => 'In Review', 'dot' => 'bg-amber-500', 'class' => 'bg-slate-100 text-slate-700'],
        'reviewed' => ['label' => 'Reviewed', 'dot' => 'bg-blue-500', 'class' => 'bg-blue-50 text-blue-700'],
        'interview' => ['label' => 'Interviewing', 'dot' => 'bg-violet-accent', 'class' => 'bg-violet-accent/10 text-violet-accent'],
        'accepted' => ['label' => 'Hired', 'dot' => 'bg-emerald-500', 'class' => 'bg-emerald-50 text-emerald-700'],
        'rejected' => ['label' => 'Rejected', 'dot' => 'bg-red-500', 'class' => 'bg-red-50 text-red-700'],
    ];
@endphp

@section('content')
<div class="relative -mx-4 -mt-5 min-h-screen overflow-hidden bg-[#faf8ff] px-4 py-6 sm:-mx-8 sm:px-8 lg:-mx-10 lg:px-10">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-0">
        <div class="absolute left-0 top-0 h-80 w-80 rounded-full bg-blue-200/50 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-violet-accent/20 blur-3xl"></div>
        <div class="absolute bottom-10 right-1/4 h-72 w-72 rounded-full bg-emerald-100/60 blur-3xl"></div>
    </div>

    <div class="relative z-10 flex flex-col gap-8">
        @if (! $canPostJob)
            <div class="glass-panel rounded-2xl border-amber-200/80 bg-amber-50/80 p-5 text-sm text-amber-900">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-extrabold">Perusahaan Anda belum diverifikasi.</p>
                        <p class="mt-1 text-amber-800">Lengkapi profil perusahaan dan tunggu verifikasi admin sebelum posting lowongan.</p>
                    </div>
                    <a href="{{ route('employer.profile') }}" class="inline-flex items-center justify-center rounded-full bg-amber-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-amber-700">
                        Lengkapi Profil
                    </a>
                </div>
            </div>
        @endif

        <section class="flex flex-col justify-between gap-5 border-b border-slate-200/60 pb-6 md:flex-row md:items-center">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Recruiter Portal</p>
                <h1 class="mt-2 text-3xl font-extrabold leading-tight text-slate-950 sm:text-5xl">Welcome back, {{ Str::words($user->name, 1, '') }}</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                    Pantau pipeline rekrutmen, aplikasi terbaru, dan performa lowongan dari satu dashboard.
                </p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ $postRoute }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-violet-accent px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition hover:brightness-105 active:scale-[0.98]">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Post a Job
                </a>
                <a href="{{ route('employer.profile') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/50 bg-white/70 px-5 py-3 text-sm font-bold text-slate-700 shadow-sm backdrop-blur transition hover:bg-white hover:text-blue-600">
                    <span class="material-symbols-outlined text-[20px]">domain</span>
                    Company Profile
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-panel group relative overflow-hidden rounded-2xl p-6">
                <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-blue-600/10 blur-xl transition group-hover:bg-blue-600/20"></div>
                <div class="relative flex items-start justify-between">
                    <div class="grid h-11 w-11 place-items-center rounded-xl bg-blue-50 text-blue-600">
                        <span class="material-symbols-outlined">work_history</span>
                    </div>
                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">+{{ $stats['jobs_this_week'] }} minggu ini</span>
                </div>
                <div class="relative mt-5">
                    <div class="text-4xl font-extrabold text-slate-950">{{ number_format($stats['active_jobs']) }}</div>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Active Jobs</p>
                </div>
            </div>

            <div class="glass-panel group relative overflow-hidden rounded-2xl p-6">
                <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-emerald-500/10 blur-xl transition group-hover:bg-emerald-500/20"></div>
                <div class="relative flex items-start justify-between">
                    <div class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-50 text-emerald-700">
                        <span class="material-symbols-outlined">group_add</span>
                    </div>
                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">+{{ $stats['applicants_today'] }} hari ini</span>
                </div>
                <div class="relative mt-5">
                    <div class="text-4xl font-extrabold text-slate-950">{{ number_format($stats['total_applicants']) }}</div>
                    <p class="mt-1 text-sm font-semibold text-slate-500">New Applications</p>
                </div>
            </div>

            <div class="glass-panel group relative overflow-hidden rounded-2xl p-6">
                <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-violet-accent/10 blur-xl transition group-hover:bg-violet-accent/20"></div>
                <div class="relative flex items-start justify-between">
                    <div class="grid h-11 w-11 place-items-center rounded-xl bg-violet-accent/10 text-violet-accent">
                        <span class="material-symbols-outlined">event_available</span>
                    </div>
                </div>
                <div class="relative mt-5">
                    <div class="text-4xl font-extrabold text-slate-950">{{ number_format($stats['interview']) }}</div>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Interviewing</p>
                </div>
            </div>

            <div class="glass-panel group relative overflow-hidden rounded-2xl p-6">
                <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-teal-500/10 blur-xl transition group-hover:bg-teal-500/20"></div>
                <div class="relative flex items-start justify-between">
                    <div class="grid h-11 w-11 place-items-center rounded-xl bg-teal-50 text-teal-700">
                        <span class="material-symbols-outlined">handshake</span>
                    </div>
                </div>
                <div class="relative mt-5">
                    <div class="text-4xl font-extrabold text-slate-950">{{ number_format($stats['accepted']) }}</div>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Hired this month</p>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-8 xl:grid-cols-3">
            <div class="glass-panel rounded-3xl p-5 sm:p-7 xl:col-span-2">
                <div class="mb-5 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-950">Recent Applications</h2>
                        <p class="mt-1 text-sm text-slate-500">Kandidat terbaru yang masuk ke lowongan perusahaan Anda.</p>
                    </div>
                    <a href="{{ $jobs->first() ? route('employer.applicants', $jobs->first()) : route('employer.dashboard') }}" class="hidden text-sm font-bold text-blue-600 hover:underline sm:inline">
                        View All
                    </a>
                </div>

                @if ($recentApplications->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white/50 py-14 text-center">
                        <span class="material-symbols-outlined text-4xl text-slate-300">group_add</span>
                        <p class="mt-3 font-bold text-slate-700">Belum ada aplikasi masuk.</p>
                        <p class="mt-1 text-sm text-slate-500">Aplikasi kandidat akan muncul di sini setelah mereka melamar.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[680px] border-collapse text-left">
                            <thead>
                                <tr class="border-b border-slate-200/70 text-sm font-bold text-slate-500">
                                    <th class="pb-3 pr-4">Candidate</th>
                                    <th class="pb-3 pr-4">Role</th>
                                    <th class="pb-3 pr-4">Status</th>
                                    <th class="pb-3 text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/50">
                                @foreach ($recentApplications as $application)
                                    @php
                                        $meta = $statusMeta[$application->status] ?? $statusMeta['pending'];
                                        $initials = collect(explode(' ', $application->seeker?->name ?? 'U'))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('');
                                    @endphp
                                    <tr class="group transition hover:bg-white/50">
                                        <td class="py-4 pr-4">
                                            <div class="flex items-center gap-3">
                                                <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-blue-100 text-sm font-extrabold text-blue-700">
                                                    {{ strtoupper($initials) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="truncate font-bold text-slate-950 transition group-hover:text-blue-600">{{ $application->seeker?->name ?? 'Kandidat' }}</p>
                                                    <p class="truncate text-xs font-semibold text-slate-500">{{ $application->seeker?->email ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 pr-4 text-sm font-semibold text-slate-700">
                                            {{ $application->job?->title ?? 'Lowongan dihapus' }}
                                        </td>
                                        <td class="py-4 pr-4">
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-bold {{ $meta['class'] }}">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $meta['dot'] }}"></span>
                                                {{ $meta['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-4 text-right text-sm font-semibold text-slate-500">
                                            {{ $application->created_at?->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="glass-panel rounded-3xl p-5 sm:p-7">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-950">Application Trends</h2>
                        <p class="mt-1 text-sm text-slate-500">Ringkasan 7 hari terakhir.</p>
                    </div>
                    <span class="material-symbols-outlined text-slate-400">more_horiz</span>
                </div>

                <div class="flex min-h-[220px] items-end gap-2">
                    @foreach ([34, 52, 45, 78, 64, 92, 84] as $height)
                        <div class="flex flex-1 items-end">
                            <div class="w-full rounded-t-md {{ $loop->iteration === 6 ? 'bg-blue-600/25' : 'bg-slate-200/80' }}" style="height: {{ $height }}%">
                                @if ($loop->iteration === 6)
                                    <div class="h-1 rounded-t-md bg-blue-600"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 border-t border-slate-200/70 pt-5">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined mt-0.5 {{ $trendIsUp ? 'text-emerald-600' : 'text-red-600' }}">{{ $trendIsUp ? 'trending_up' : 'trending_down' }}</span>
                        <p class="text-sm leading-6 text-slate-700">
                            Applications are {{ $trendIsUp ? 'up' : 'down' }}
                            <strong class="{{ $trendIsUp ? 'text-emerald-700' : 'text-red-700' }}">{{ abs($applicationTrend) }}%</strong>
                            this week compared to last week.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="glass-panel rounded-3xl p-5 sm:p-7">
            <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-950">Jobs</h2>
                    <p class="mt-1 text-sm text-slate-500">Kelola posting dan pelamar dari satu tempat.</p>
                </div>
                <a href="{{ $postRoute }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-bold text-blue-600 shadow-sm ring-1 ring-blue-100 transition hover:bg-blue-50">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Posting
                </a>
            </div>

            @if ($jobs->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white/50 py-14 text-center">
                    <span class="material-symbols-outlined text-4xl text-slate-300">work</span>
                    <p class="mt-3 font-bold text-slate-700">Belum ada lowongan.</p>
                    <p class="mt-1 text-sm text-slate-500">Buat posting pertama setelah perusahaan terverifikasi.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] border-collapse text-left">
                        <thead>
                            <tr class="border-b border-slate-200/70 text-xs font-bold uppercase tracking-wide text-slate-500">
                                <th class="pb-3 pr-4">Judul</th>
                                <th class="pb-3 pr-4">Status</th>
                                <th class="pb-3 pr-4">Pelamar</th>
                                <th class="pb-3 pr-4">Dibuat</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/50">
                            @foreach ($jobs as $job)
                                <tr class="transition hover:bg-white/50">
                                    <td class="py-4 pr-4">
                                        <a href="{{ route('jobs.show', $job) }}" class="font-extrabold text-slate-950 transition hover:text-blue-600">{{ $job->title }}</a>
                                    </td>
                                    <td class="py-4 pr-4">
                                        <x-badge :color="$job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'red')">{{ ucfirst($job->status) }}</x-badge>
                                    </td>
                                    <td class="py-4 pr-4 font-bold text-slate-700">{{ $job->applications_count }}</td>
                                    <td class="py-4 pr-4 text-sm font-semibold text-slate-500">{{ $job->created_at->format('d M Y') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center justify-end gap-3 text-sm font-bold">
                                            <a href="{{ route('employer.applicants', $job) }}" class="text-blue-600 hover:underline">Pelamar</a>
                                            <a href="{{ route('employer.lowongan.edit', $job) }}" class="text-slate-500 hover:text-blue-600">Edit</a>
                                            <form action="{{ route('employer.lowongan.destroy', $job) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
