@extends('layouts.dashboard', ['title' => 'Kelola Kategori'])

@section('content')
@php $editing = $editing ?? null; @endphp
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-1">
        <div class="card p-6 lg:sticky lg:top-24">
            <h2 class="font-bold text-ink-900 mb-4">{{ $editing ? '✏️ Edit Kategori' : '➕ Tambah Kategori' }}</h2>
            <form action="{{ $editing ? route('admin.categories.update', $editing) : route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                @if ($editing) @method('PUT') @endif
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $editing?->name) }}" required class="field">
                    @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $editing?->icon) }}" maxlength="10" placeholder="💻" class="field">
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

    <!-- List -->
    <div class="lg:col-span-2">
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100"><h2 class="font-bold text-ink-900">Daftar Kategori</h2></div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr><th>Icon</th><th>Nama</th><th>Slug</th><th>Lowongan</th><th class="text-right">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-2xl">{{ $category->icon }}</td>
                                <td class="font-semibold text-ink-900">{{ $category->name }}</td>
                                <td class="text-ink-500">{{ $category->slug }}</td>
                                <td><x-badge color="brand">{{ $category->jobs_count }}</x-badge></td>
                                <td class="text-right">
                                    <div class="flex items-center justify-end gap-3 text-sm font-medium">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-brand-600 hover:underline">Edit</a>
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
