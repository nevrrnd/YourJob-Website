@extends('layouts.dashboard', ['title' => 'Dashboard Pelamar'])

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([
            ['Total Lamaran', $stats['total'], '📨', 'from-brand-500 to-brand-700'],
            ['Menunggu', $stats['pending'], '⏳', 'from-amber-400 to-amber-600'],
            ['Interview', $stats['interview'], '🗣️', 'from-sky-500 to-blue-600'],
            ['Diterima', $stats['accepted'], '🎉', 'from-emerald-500 to-green-600'],
        ] as [$label, $value, $icon, $grad])
            <div class="card card-hover p-5 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-gradient-to-br {{ $grad }} opacity-10"></div>
                <div class="relative flex items-center justify-between">
                    <div class="grid place-items-center w-11 h-11 rounded-xl bg-gradient-to-br {{ $grad }} text-white text-lg shadow-soft">{{ $icon }}</div>
                </div>
                <div class="relative mt-3 text-3xl font-extrabold text-ink-900">{{ $value }}</div>
                <div class="relative text-sm text-ink-500">{{ $label }}</div>
            </div>
        @endforeach
    </div>

    <!-- Recent applications -->
    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-ink-100 flex items-center justify-between">
            <h2 class="font-bold text-ink-900">Lamaran Terbaru</h2>
            <a href="{{ route('seeker.applications') }}" class="text-sm font-semibold text-brand-600 hover:underline">Lihat semua</a>
        </div>
        @if ($applications->isEmpty())
            <div class="p-12 text-center">
                <div class="text-4xl mb-3">🗂️</div>
                <p class="text-ink-500">Belum ada lamaran. <a href="{{ route('jobs.index') }}" class="text-brand-600 font-semibold hover:underline">Cari lowongan</a>.</p>
            </div>
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
                                <td>
                                    <a href="{{ route('jobs.show', $app->job) }}" class="font-semibold text-ink-900 hover:text-brand-600">{{ $app->job->title }}</a>
                                </td>
                                <td class="text-ink-600">{{ $app->job->employer?->companyProfile?->company_name ?? '—' }}</td>
                                <td class="text-ink-500">{{ $app->created_at->format('d M Y') }}</td>
                                <td><span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $app->status_color }}">{{ $app->status_label }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
