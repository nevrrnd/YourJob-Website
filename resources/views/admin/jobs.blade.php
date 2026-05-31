@extends('layouts.dashboard', ['title' => 'Kelola Lowongan'])

@section('content')
<div class="card overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h2 class="font-bold text-ink-900">Semua Lowongan</h2>
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul" class="field text-sm !w-auto">
            <select name="status" class="field text-sm !w-auto">
                <option value="">Semua status</option>
                @foreach (['active'=>'Aktif','draft'=>'Draft','closed'=>'Ditutup'] as $val => $label)
                    <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="btn-primary btn-sm">Cari</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Perusahaan</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Pelamar</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td><a href="{{ route('jobs.show', $job) }}" class="font-semibold text-ink-900 hover:text-brand-600">{{ $job->title }}</a></td>
                        <td class="text-ink-600">{{ $job->employer?->companyProfile?->company_name ?? $job->employer?->name }}</td>
                        <td class="text-ink-600">{{ $job->category?->name }}</td>
                        <td>
                            @php $sc = $job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'red'); @endphp
                            <x-badge :color="$sc">{{ ucfirst($job->status) }}</x-badge>
                        </td>
                        <td><x-badge color="brand">{{ $job->applications_count }}</x-badge></td>
                        <td class="text-right">
                            <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><x-empty-state icon="💼" title="Belum ada lowongan" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $jobs->links() }}</div>
</div>
@endsection
