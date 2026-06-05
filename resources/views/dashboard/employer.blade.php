@extends('layouts.dashboard', ['title' => 'Dashboard Employer'])

@section('content')
<div class="space-y-6">
    @if (! auth()->user()->companyProfile?->is_verified)
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
            <p class="font-semibold">Perusahaan Anda belum diverifikasi.</p>
            <p class="mt-1">Lengkapi <a href="{{ route('employer.profile') }}" class="underline font-bold">profil perusahaan</a> dan tunggu verifikasi admin.</p>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4">
        <x-stat-card label="Lowongan Aktif" :value="$stats['active_jobs']" icon="work" />
        <x-stat-card label="Total Pelamar" :value="$stats['total_applicants']" icon="group" />
        <x-stat-card label="Interview" :value="$stats['interview']" icon="event" />
        <x-stat-card label="Diterima" :value="$stats['accepted']" icon="verified" />
    </div>

    <div class="card overflow-hidden">
        <div class="flex items-center justify-between border-b border-[#e5e7eb] px-6 py-5">
            <div>
                <h2 class="section-title">Lowongan Saya</h2>
                <p class="mt-1 text-sm text-[#737688]">Kelola posting dan pelamar dari satu tempat.</p>
            </div>
            @if (auth()->user()->companyProfile?->is_verified)
                <a href="{{ route('employer.lowongan.create') }}" class="btn-primary btn-sm">Posting</a>
            @endif
        </div>
        @if ($jobs->isEmpty())
            <x-empty-state title="Belum ada lowongan">
                Buat posting pertama setelah perusahaan terverifikasi.
            </x-empty-state>
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
                                <td><a href="{{ route('jobs.show', $job) }}" class="font-bold text-[#1a1c1e] hover:text-[#003ec7]">{{ $job->title }}</a></td>
                                <td><x-badge :color="$job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'red')">{{ ucfirst($job->status) }}</x-badge></td>
                                <td class="text-ink-600 font-semibold">{{ $job->applications_count }}</td>
                                <td class="text-ink-500">{{ $job->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="flex items-center justify-end gap-3 text-sm font-semibold">
                                        <a href="{{ route('employer.applicants', $job) }}" class="link-brand">Pelamar</a>
                                        <a href="{{ route('employer.lowongan.edit', $job) }}" class="text-[#434656] hover:text-[#003ec7]">Edit</a>
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
    </div>
</div>
@endsection
