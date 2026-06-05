@extends('layouts.dashboard', ['title' => 'Dashboard Admin'])

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4">
        <x-stat-card label="Total Pengguna" :value="number_format($stats['users'])" icon="group" />
        <x-stat-card label="Lowongan Aktif" :value="number_format($stats['active_jobs'])" icon="work" />
        <x-stat-card label="Total Lamaran" :value="number_format($stats['applications'])" icon="assignment" />
        <x-stat-card label="Perusahaan" :value="number_format($stats['companies'])" icon="domain" />
    </div>

    <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
        <div class="card p-4 text-sm sm:p-5"><span class="text-[#737688]">Pencari Kerja</span><div class="text-2xl font-extrabold text-[#1a1c1e]">{{ $stats['seekers'] }}</div></div>
        <div class="card p-4 text-sm sm:p-5"><span class="text-[#737688]">Pemberi Kerja</span><div class="text-2xl font-extrabold text-[#1a1c1e]">{{ $stats['employers'] }}</div></div>
        <div class="card p-4 text-sm sm:p-5"><span class="text-[#737688]">Total Lowongan</span><div class="text-2xl font-extrabold text-[#1a1c1e]">{{ $stats['jobs'] }}</div></div>
        <div class="card p-4 text-sm sm:p-5"><span class="text-[#737688]">Menunggu Verifikasi</span><div class="text-2xl font-extrabold text-[#003ec7]">{{ $stats['pending_companies'] }}</div></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card overflow-hidden">
            <div class="flex items-center justify-between border-b border-[#e5e7eb] px-6 py-5">
                <h2 class="section-title">Lowongan Terbaru</h2>
                <a href="{{ route('admin.jobs') }}" class="link-brand text-sm">Semua</a>
            </div>
            <div class="divide-y divide-ink-100">
                @forelse ($recentJobs as $job)
                    <div class="flex items-center justify-between px-6 py-4 text-sm transition hover:bg-[#f7f8f9]">
                        <div>
                            <a href="{{ route('jobs.show', $job) }}" class="font-bold text-[#1a1c1e] hover:text-[#003ec7]">{{ $job->title }}</a>
                            <p class="text-ink-500 text-xs">{{ $job->employer?->companyProfile?->company_name ?? $job->employer?->name }}</p>
                        </div>
                        <span class="text-xs text-ink-400">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <x-empty-state title="Belum ada lowongan" class="!p-8" />
                @endforelse
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="border-b border-[#e5e7eb] px-6 py-5">
                <h2 class="section-title">Statistik per Kategori</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr><th>Kategori</th><th>Lowongan</th><th>Lamaran</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryStats as $cat)
                            <tr>
                                <td class="font-bold text-ink-800">{{ $cat->name }}</td>
                                <td class="text-ink-600">{{ $cat->total_jobs }}</td>
                                <td class="text-ink-600">{{ $cat->total_applications }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
