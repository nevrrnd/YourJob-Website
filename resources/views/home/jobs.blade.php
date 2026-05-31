@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <span class="eyebrow">Eksplorasi</span>
        <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold premium-heading">Browse Lowongan</h1>
        <p class="mt-2 text-ink-500">{{ number_format($jobs->total()) }} lowongan tersedia untukmu</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <aside class="lg:col-span-1">
            <form action="{{ route('jobs.index') }}" method="GET" class="premium-panel rounded-[2rem] p-5 space-y-4 lg:sticky lg:top-24">
                <div class="flex items-center gap-2 text-ink-900 font-bold">Filter</div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kata Kunci</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Posisi / skill" class="field text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kategori</label>
                    <select name="category" class="field text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->icon }} {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Tipe Pekerjaan</label>
                    <select name="type" class="field text-sm">
                        <option value="">Semua Tipe</option>
                        @foreach (['full_time'=>'Full Time','part_time'=>'Part Time','freelance'=>'Freelance','internship'=>'Magang','contract'=>'Kontrak'] as $val => $label)
                            <option value="{{ $val }}" @selected(request('type') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kota</label>
                    <input type="text" name="city" value="{{ request('city') }}" placeholder="mis. Jakarta" class="field text-sm">
                </div>
                <button class="btn-primary w-full">Terapkan Filter</button>
                <a href="{{ route('jobs.index') }}" class="block text-center text-sm text-ink-500 hover:text-[#2c7da0]">Reset filter</a>
            </form>
        </aside>

        <div class="lg:col-span-3">
            @if ($jobs->isEmpty())
                <div class="card">
                    <x-empty-state icon="" title="Tidak ada lowongan yang cocok">
                        Coba ubah kata kunci atau reset filter untuk melihat semua lowongan.
                    </x-empty-state>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($jobs as $job)
                        @include('partials.job-card', ['job' => $job])
                    @endforeach
                </div>
                <div class="mt-8">{{ $jobs->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
