@extends('layouts.dashboard', ['title' => 'Dashboard Pelamar'])

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4">
        <x-stat-card label="Total Lamaran" :value="$stats['total']" icon="assignment" />
        <x-stat-card label="Menunggu" :value="$stats['pending']" icon="hourglass_top" />
        <x-stat-card label="Interview" :value="$stats['interview']" icon="groups" />
        <x-stat-card label="Diterima" :value="$stats['accepted']" icon="verified" />
    </div>

    <div class="card overflow-hidden">
        <div class="flex items-center justify-between border-b border-[#e5e7eb] px-6 py-5">
            <div>
                <h2 class="section-title">Lamaran Terbaru</h2>
                <p class="mt-1 text-sm text-[#737688]">Pantau status lamaran terakhirmu.</p>
            </div>
            <a href="{{ route('seeker.applications') }}" class="link-brand text-sm">Lihat semua</a>
        </div>
        @if ($applications->isEmpty())
            <x-empty-state title="Belum ada lamaran">
                Mulai cari lowongan yang cocok dengan profilmu.
                <a href="{{ route('jobs.index') }}" class="link-brand">Cari lowongan</a>.
            </x-empty-state>
        @else
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications->take(5) as $app)
                            <tr>
                                <td><a href="{{ route('jobs.show', $app->job) }}" class="font-bold text-[#1a1c1e] hover:text-[#003ec7]">{{ $app->job->title }}</a></td>
                                <td class="text-ink-600">{{ $app->job->employer?->companyProfile?->company_name ?? '-' }}</td>
                                <td class="text-ink-500">{{ $app->created_at->format('d M Y') }}</td>
                                <td><span class="chip">{{ $app->status_label }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
