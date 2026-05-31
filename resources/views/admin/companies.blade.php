@extends('layouts.dashboard', ['title' => 'Kelola Perusahaan'])

@section('content')
<div class="card overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h2 class="font-bold text-ink-900">Daftar Perusahaan</h2>
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari perusahaan" class="field text-sm !w-auto">
            <select name="verified" class="field text-sm !w-auto">
                <option value="">Semua status</option>
                <option value="1" @selected(request('verified') === '1')>Terverifikasi</option>
                <option value="0" @selected(request('verified') === '0')>Belum</option>
            </select>
            <button class="btn-primary btn-sm">Cari</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>Email</th>
                    <th>Industri</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                @if ($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" class="w-9 h-9 rounded-lg object-cover ring-1 ring-ink-200">
                                @else
                                    <div class="grid place-items-center w-9 h-9 rounded-lg bg-brand-50 text-base">🏢</div>
                                @endif
                                <span class="font-semibold text-ink-900">{{ $company->company_name }}</span>
                            </div>
                        </td>
                        <td class="text-ink-600">{{ $company->user?->email }}</td>
                        <td class="text-ink-600">{{ $company->industry ?? '—' }}</td>
                        <td><x-badge :color="$company->is_verified ? 'green' : 'amber'">{{ $company->is_verified ? 'Terverifikasi' : 'Menunggu' }}</x-badge></td>
                        <td class="text-right">
                            <form action="{{ route('admin.companies.verify', $company) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn-sm {{ $company->is_verified ? 'btn-ghost !text-red-600' : 'btn-primary' }}">
                                    {{ $company->is_verified ? 'Batalkan' : '✓ Verifikasi' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state icon="🏢" title="Belum ada perusahaan" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $companies->links() }}</div>
</div>
@endsection
