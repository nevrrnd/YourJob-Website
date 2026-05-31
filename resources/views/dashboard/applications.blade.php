@extends('layouts.dashboard', ['title' => 'Riwayat Lamaran'])

@section('content')
<div class="card overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100">
        <h2 class="font-bold text-ink-900">Semua Lamaran Saya</h2>
    </div>
    @if ($applications->isEmpty())
        <x-empty-state icon="🗂️" title="Belum ada lamaran">
            Mulai lamar lowongan. <a href="{{ route('jobs.index') }}" class="text-brand-600 font-semibold hover:underline">Cari lowongan</a>.
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
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $app)
                        <tr>
                            <td><a href="{{ route('jobs.show', $app->job) }}" class="font-semibold text-ink-900 hover:text-brand-600">{{ $app->job->title }}</a></td>
                            <td class="text-ink-600">{{ $app->job->employer?->companyProfile?->company_name ?? '—' }}</td>
                            <td class="text-ink-500">{{ $app->created_at->format('d M Y') }}</td>
                            <td><span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $app->status_color }}">{{ $app->status_label }}</span></td>
                            <td class="text-ink-500">{{ $app->employer_note ?: '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
