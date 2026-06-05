@extends('layouts.dashboard', ['title' => 'Kelola Perusahaan'])

@section('content')
<div class="card overflow-hidden">
    <div class="flex flex-col justify-between gap-3 border-b border-[#e5e7eb] px-6 py-5 sm:flex-row sm:items-center">
        <h2 class="font-bold text-[#1a1c1e]">Daftar Perusahaan</h2>
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari perusahaan" class="field !w-auto text-sm">
            <select name="verified" class="field !w-auto text-sm">
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
                                    <img src="{{ asset('storage/' . $company->logo) }}" class="h-9 w-9 rounded-lg object-cover ring-1 ring-[#e5e7eb]">
                                @else
                                    <div class="grid h-9 w-9 place-items-center rounded-lg bg-[#dde1ff] text-[#003ec7]"><span class="material-symbols-outlined text-[18px]">domain</span></div>
                                @endif
                                <span class="font-bold text-[#1a1c1e]">{{ $company->company_name }}</span>
                            </div>
                        </td>
                        <td class="text-[#434656]">{{ $company->user?->email }}</td>
                        <td class="text-[#434656]">{{ $company->industry ?? '-' }}</td>
                        <td><x-badge :color="$company->is_verified ? 'green' : 'amber'">{{ $company->is_verified ? 'Terverifikasi' : 'Menunggu' }}</x-badge></td>
                        <td class="text-right">
                            <form action="{{ route('admin.companies.verify', $company) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn-sm {{ $company->is_verified ? 'btn-ghost !text-red-600' : 'btn-primary' }}">
                                    {{ $company->is_verified ? 'Batalkan' : 'Verifikasi' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state icon="domain" title="Belum ada perusahaan" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $companies->links() }}</div>
</div>
@endsection
