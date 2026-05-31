@extends('layouts.dashboard', ['title' => 'Edit Lowongan'])

@section('content')
<div class="max-w-3xl">
    <x-page-header title="Edit Lowongan" subtitle="Perbarui informasi lowongan kamu">
        <a href="{{ route('jobs.show', $job) }}" class="btn-ghost btn-sm">Lihat publik →</a>
    </x-page-header>
    <form action="{{ route('employer.lowongan.update', $job) }}" method="POST">
        @csrf
        @method('PUT')
        @include('jobs._form', ['job' => $job])
        <div class="mt-6 flex gap-3">
            <button class="btn-primary">💾 Perbarui</button>
            <a href="{{ route('employer.dashboard') }}" class="btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
