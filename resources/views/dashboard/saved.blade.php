@extends('layouts.dashboard', ['title' => 'Lowongan Tersimpan'])

@section('content')
<div>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-[#1a1c1e]">Lowongan Tersimpan</h2>
            <p class="mt-2 text-[#737688]">Lowongan favorit yang bisa kamu cek kembali.</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="btn-primary">Jelajahi Lowongan</a>
    </div>

    @if ($jobs->isEmpty())
        <div class="card">
            <x-empty-state icon="bookmark" title="Belum ada lowongan tersimpan">
                Jelajahi lowongan dan simpan favoritmu.
            </x-empty-state>
        </div>
    @else
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($jobs as $job)
                @include('partials.job-card', ['job' => $job])
            @endforeach
        </div>
        <div class="mt-8">{{ $jobs->links() }}</div>
    @endif
</div>
@endsection
