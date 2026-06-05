@extends('layouts.dashboard', ['title' => 'Kelola Kategori'])

@section('content')
@php $editing = $editing ?? null; @endphp
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div>
        <div class="card sticky top-24 p-6">
            <h2 class="mb-4 text-xl font-extrabold text-[#1a1c1e]">{{ $editing ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
            <form action="{{ $editing ? route('admin.categories.update', $editing) : route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                @if ($editing) @method('PUT') @endif
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $editing?->name) }}" required class="field">
                    @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-[#434656]">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $editing?->icon) }}" maxlength="10" placeholder="work" class="field">
                </div>
                <div class="flex gap-2">
                    <button class="btn-primary">{{ $editing ? 'Perbarui' : 'Tambah' }}</button>
                    @if ($editing)
                        <a href="{{ route('admin.categories.index') }}" class="btn-ghost">Batal</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="card overflow-hidden">
            <div class="border-b border-[#e5e7eb] px-6 py-5"><h2 class="font-bold text-[#1a1c1e]">Daftar Kategori</h2></div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr><th>Icon</th><th>Nama</th><th>Slug</th><th>Lowongan</th><th class="text-right">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td><span class="material-symbols-outlined text-[#003ec7]">category</span></td>
                                <td class="font-bold text-[#1a1c1e]">{{ $category->name }}</td>
                                <td class="text-[#737688]">{{ $category->slug }}</td>
                                <td><x-badge color="brand">{{ $category->jobs_count }}</x-badge></td>
                                <td class="text-right">
                                    <div class="flex items-center justify-end gap-3 text-sm font-bold">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-[#003ec7] hover:underline">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
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
        </div>
    </div>
</div>
@endsection
