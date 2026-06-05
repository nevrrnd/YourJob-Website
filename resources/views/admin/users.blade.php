@extends('layouts.dashboard', ['title' => 'Kelola Pengguna'])

@section('content')
<div class="card overflow-hidden">
    <div class="flex flex-col justify-between gap-3 border-b border-[#e5e7eb] px-6 py-5 sm:flex-row sm:items-center">
        <h2 class="font-bold text-[#1a1c1e]">Daftar Pengguna</h2>
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email" class="field !w-auto text-sm">
            <select name="role" class="field !w-auto text-sm">
                <option value="">Semua role</option>
                @foreach (['admin'=>'Admin','employer'=>'Employer','seeker'=>'Seeker'] as $val => $label)
                    <option value="{{ $val }}" @selected(request('role') === $val)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="btn-primary btn-sm">Cari</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="grid h-9 w-9 place-items-center rounded-full bg-[#dde1ff] text-xs font-bold text-[#003ec7]">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-bold text-[#1a1c1e]">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-[#434656]">{{ $user->email }}</td>
                        <td>
                            @php $rc = $user->role === 'admin' ? 'violet' : ($user->role === 'employer' ? 'sky' : 'brand'); @endphp
                            <x-badge :color="$rc" class="capitalize">{{ $user->role }}</x-badge>
                        </td>
                        <td><x-badge :color="$user->is_active ? 'green' : 'red'">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</x-badge></td>
                        <td>
                            @if (! $user->isAdmin())
                                <div class="flex items-center justify-end gap-3 text-sm font-bold">
                                    <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-[#003ec7] hover:underline">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            @else
                                <span class="block text-right text-xs text-[#737688]">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state icon="group" title="Tidak ada pengguna" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
