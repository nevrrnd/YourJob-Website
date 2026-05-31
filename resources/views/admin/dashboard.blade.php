@extends('layouts.dashboard', ['title' => 'Dashboard Admin'])

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card label="Total Pengguna" :value="number_format($stats['users'])" icon="👥" grad="from-brand-500 to-brand-700" />
        <x-stat-card label="Lowongan Aktif" :value="number_format($stats['active_jobs'])" icon="💼" grad="from-sky-500 to-blue-600" />
        <x-stat-card label="Total Lamaran" :value="number_format($stats['applications'])" icon="📄" grad="from-indigo-500 to-brand-600" />
        <x-stat-card label="Perusahaan" :value="number_format($stats['companies'])" icon="🏢" grad="from-emerald-500 to-green-600" />
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="card p-4 text-sm"><span class="text-ink-500">Pencari Kerja</span><div class="text-xl font-extrabold text-ink-900">{{ $stats['seekers'] }}</div></div>
        <div class="card p-4 text-sm"><span class="text-ink-500">Pemberi Kerja</span><div class="text-xl font-extrabold text-ink-900">{{ $stats['employers'] }}</div></div>
        <div class="card p-4 text-sm"><span class="text-ink-500">Total Lowongan</span><div class="text-xl font-extrabold text-ink-900">{{ $stats['jobs'] }}</div></div>
        <div class="card p-4 text-sm"><span class="text-ink-500">Menunggu Verifikasi</span><div class="text-xl font-extrabold text-amber-600">{{ $stats['pending_companies'] }}</div></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent jobs -->
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100 flex items-center justify-between">
                <h2 class="font-bold text-ink-900">Lowongan Terbaru</h2>
                <a href="{{ route('admin.jobs') }}" class="text-sm font-semibold text-brand-600 hover:underline">Semua</a>
            </div>
            <div class="divide-y divide-ink-100">
                @forelse ($recentJobs as $job)
                    <div class="px-5 py-3.5 flex items-center justify-between text-sm hover:bg-brand-50/40 transition">
                        <div>
                            <a href="{{ route('jobs.show', $job) }}" class="font-semibold text-ink-900 hover:text-brand-600">{{ $job->title }}</a>
                            <p class="text-ink-500 text-xs">{{ $job->employer?->companyProfile?->company_name ?? $job->employer?->name }}</p>
                        </div>
                        <span class="text-xs text-ink-400">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <x-empty-state icon="💼" title="Belum ada lowongan" class="!p-8" />
                @endforelse
            </div>
        </div>

        <!-- Category aggregation -->
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100">
                <h2 class="font-bold text-ink-900">Statistik per Kategori</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr><th>Kategori</th><th>Lowongan</th><th>Lamaran</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryStats as $cat)
                            <tr>
                                <td class="font-medium text-ink-800">{{ $cat->icon }} {{ $cat->name }}</td>
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
