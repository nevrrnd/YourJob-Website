@extends('layouts.dashboard', ['title' => 'Lowongan Tersimpan'])

@section('content')
<div>
    <x-page-header title="Lowongan Tersimpan" subtitle="Lowongan yang kamu bookmark" />
    @if ($jobs->isEmpty())
        <div class="card">
            <x-empty-state icon="🔖" title="Belum ada lowongan tersimpan">
                <a href="{{ route('jobs.index') }}" class="text-brand-600 font-semibold hover:underline">Jelajahi lowongan</a> dan simpan favoritmu.
            </x-empty-state>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($jobs as $job)
                @include('partials.job-card', ['job' => $job])
            @endforeach
        </div>
        <div class="mt-8">{{ $jobs->links() }}</div>
    @endif
</div>
@endsection
