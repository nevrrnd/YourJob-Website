@extends('layouts.dashboard', ['title' => 'Kelola Pengguna'])

@section('content')
<div class="card overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h2 class="font-bold text-ink-900">Daftar Pengguna</h2>
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email" class="field text-sm !w-auto">
            <select name="role" class="field text-sm !w-auto">
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
                                <div class="grid place-items-center w-9 h-9 rounded-full bg-brand-gradient text-white text-xs font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-semibold text-ink-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-ink-600">{{ $user->email }}</td>
                        <td>
                            @php $rc = $user->role === 'admin' ? 'violet' : ($user->role === 'employer' ? 'sky' : 'brand'); @endphp
                            <x-badge :color="$rc" class="capitalize">{{ $user->role }}</x-badge>
                        </td>
                        <td><x-badge :color="$user->is_active ? 'green' : 'red'">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</x-badge></td>
                        <td>
                            @if (! $user->isAdmin())
                                <div class="flex items-center justify-end gap-3 text-sm font-medium">
                                    <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-brand-600 hover:underline">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-ink-400 block text-right">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-empty-state icon="👥" title="Tidak ada pengguna" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
