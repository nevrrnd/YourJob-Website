@extends('layouts.dashboard', ['title' => 'Riwayat Lamaran'])

@section('content')
<div class="card overflow-hidden">
    <div class="border-b border-[#e5e7eb] px-6 py-5">
        <h2 class="font-bold text-[#1a1c1e]">Semua Lamaran Saya</h2>
        <p class="mt-1 text-sm text-[#737688]">Pantau setiap aplikasi dan catatan dari perusahaan.</p>
    </div>
    @if ($applications->isEmpty())
        <x-empty-state icon="assignment" title="Belum ada lamaran">
            Mulai lamar lowongan. <a href="{{ route('jobs.index') }}" class="font-semibold text-[#003ec7] hover:underline">Cari lowongan</a>.
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
                            <td><a href="{{ route('jobs.show', $app->job) }}" class="font-bold text-[#1a1c1e] hover:text-[#003ec7]">{{ $app->job->title }}</a></td>
                            <td class="text-[#434656]">{{ $app->job->employer?->companyProfile?->company_name ?? '-' }}</td>
                            <td class="text-[#737688]">{{ $app->created_at->format('d M Y') }}</td>
                            <td><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $app->status_color }}">{{ $app->status_label }}</span></td>
                            <td class="text-[#737688]">{{ $app->employer_note ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
