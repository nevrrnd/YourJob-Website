@extends('layouts.dashboard', ['title' => 'Dashboard Employer'])

@section('content')
<div class="space-y-6">
    @if (! auth()->user()->companyProfile?->is_verified)
        <div class="card border-amber-200 bg-amber-50/80 p-4 flex items-start gap-3 text-sm text-amber-800">
            <span class="text-lg">⚠️</span>
            <p>Perusahaan Anda belum diverifikasi admin sehingga belum dapat memposting lowongan.
            Lengkapi <a href="{{ route('employer.profile') }}" class="underline font-semibold">profil perusahaan</a> dan tunggu verifikasi.</p>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([
            ['Lowongan Aktif', $stats['active_jobs'], '💼', 'from-brand-500 to-brand-700'],
            ['Total Pelamar', $stats['total_applicants'], '👥', 'from-sky-500 to-blue-600'],
            ['Interview', $stats['interview'], '🗣️', 'from-indigo-500 to-brand-600'],
            ['Diterima', $stats['accepted'], '🎉', 'from-emerald-500 to-green-600'],
        ] as [$label, $value, $icon, $grad])
            <div class="card card-hover p-5 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 rounded-full bg-gradient-to-br {{ $grad }} opacity-10"></div>
                <div class="relative grid place-items-center w-11 h-11 rounded-xl bg-gradient-to-br {{ $grad }} text-white text-lg shadow-soft">{{ $icon }}</div>
                <div class="relative mt-3 text-3xl font-extrabold text-ink-900">{{ $value }}</div>
                <div class="relative text-sm text-ink-500">{{ $label }}</div>
            </div>
        @endforeach
    </div>

    <!-- Jobs table -->
    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-ink-100 flex items-center justify-between">
            <h2 class="font-bold text-ink-900">Lowongan Saya</h2>
            @if (auth()->user()->companyProfile?->is_verified)
                <a href="{{ route('employer.lowongan.create') }}" class="btn-primary btn-sm">+ Posting</a>
            @endif
        </div>
        @if ($jobs->isEmpty())
            <div class="p-12 text-center">
                <div class="text-4xl mb-3">📭</div>
                <p class="text-ink-500">Belum ada lowongan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Pelamar</th>
                            <th>Dibuat</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td><a href="{{ route('jobs.show', $job) }}" class="font-semibold text-ink-900 hover:text-brand-600">{{ $job->title }}</a></td>
                                <td>
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $job->status === 'active' ? 'bg-green-100 text-green-700' : ($job->status === 'draft' ? 'bg-ink-100 text-ink-600' : 'bg-red-100 text-red-700') }}">{{ ucfirst($job->status) }}</span>
                                </td>
                                <td class="text-ink-600 font-medium">{{ $job->applications_count }}</td>
                                <td class="text-ink-500">{{ $job->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="flex items-center justify-end gap-3 text-sm font-medium">
                                        <a href="{{ route('employer.applicants', $job) }}" class="text-brand-600 hover:underline">Pelamar</a>
                                        <a href="{{ route('employer.lowongan.edit', $job) }}" class="text-ink-600 hover:underline">Edit</a>
                                        <form action="{{ route('employer.lowongan.destroy', $job) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
