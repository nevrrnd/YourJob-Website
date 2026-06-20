@extends('layouts.dashboard', ['title' => 'Dashboard Pelamar'])

@section('content')
<div class="space-y-8">
    <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <x-stat-card label="Total Lamaran" :value="$stats['total']" icon="assignment" />
        <x-stat-card label="Menunggu" :value="$stats['pending']" icon="hourglass_top" />
        <x-stat-card label="Interview" :value="$stats['interview']" icon="groups" />
        <x-stat-card label="Diterima" :value="$stats['accepted']" icon="verified" />
    </section>

    <section class="grid grid-cols-1 gap-8 xl:grid-cols-3">
        <div class="glass-panel rounded-3xl p-5 sm:p-7 xl:col-span-2">
            <div class="mb-6 flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-950">Applied Jobs Tracker</h2>
                    <p class="mt-1 text-sm text-slate-500">Pantau status lamaran terakhirmu.</p>
                </div>
                <a href="{{ route('seeker.applications') }}" class="text-sm font-bold text-blue-600 hover:underline">View All</a>
            </div>

            @if ($applications->isEmpty())
                <x-empty-state title="Belum ada lamaran">
                    Mulai cari lowongan yang cocok dengan profilmu.
                    <a href="{{ route('jobs.index') }}" class="font-bold text-blue-600 hover:underline">Cari lowongan</a>.
                </x-empty-state>
            @else
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($applications->take(3) as $app)
                        @php
                            $statusClass = match ($app->status) {
                                'interview' => 'border-violet-accent text-violet-accent bg-violet-accent/10',
                                'accepted' => 'border-emerald-600 text-emerald-700 bg-emerald-50',
                                'rejected' => 'border-red-600 text-red-700 bg-red-50',
                                default => 'border-blue-600 text-blue-700 bg-blue-50',
                            };
                        @endphp
                        <article class="relative overflow-hidden rounded-2xl border border-white/50 bg-white/60 p-5 shadow-sm">
                            <div class="absolute left-0 top-0 h-full w-1.5 {{ explode(' ', $statusClass)[0] }}"></div>
                            <div class="mb-4 flex items-start justify-between gap-3">
                                <div class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600">
                                    <span class="material-symbols-outlined">work</span>
                                </div>
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $statusClass }}">{{ $app->status_label }}</span>
                            </div>
                            <h3 class="line-clamp-2 font-extrabold text-slate-950">
                                <a href="{{ route('jobs.show', $app->job) }}" class="hover:text-blue-600">{{ $app->job->title }}</a>
                            </h3>
                            <p class="mt-1 truncate text-sm text-slate-500">{{ $app->job->employer?->companyProfile?->company_name ?? '-' }}</p>
                            <p class="mt-5 border-t border-slate-200/70 pt-3 text-xs font-semibold text-slate-400">Applied {{ $app->created_at->diffForHumans() }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

        <aside class="glass-panel rounded-3xl p-5 sm:p-7">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-slate-950">Quick Actions</h2>
                <span class="material-symbols-outlined text-slate-400">bolt</span>
            </div>
            <div class="space-y-3">
                <a href="{{ route('jobs.index') }}" class="flex items-center justify-between rounded-2xl bg-white/60 p-4 font-bold text-slate-700 transition hover:bg-blue-600 hover:text-white">
                    Cari Lowongan
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </a>
                <a href="{{ route('seeker.saved') }}" class="flex items-center justify-between rounded-2xl bg-white/60 p-4 font-bold text-slate-700 transition hover:bg-blue-600 hover:text-white">
                    Lowongan Tersimpan
                    <span class="material-symbols-outlined text-[20px]">bookmark</span>
                </a>
                <a href="{{ route('seeker.profile') }}" class="flex items-center justify-between rounded-2xl bg-white/60 p-4 font-bold text-slate-700 transition hover:bg-blue-600 hover:text-white">
                    Lengkapi Profil
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </a>
            </div>
        </aside>
    </section>
</div>
@endsection
