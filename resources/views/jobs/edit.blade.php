@extends('layouts.dashboard', ['title' => 'Edit Lowongan'])

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-[#1a1c1e]">Edit Lowongan</h2>
            <p class="mt-2 text-[#737688]">Perbarui informasi lowongan kamu.</p>
        </div>
        <a href="{{ route('jobs.show', $job) }}" class="btn-ghost btn-sm">Lihat publik</a>
    </div>
    <form action="{{ route('employer.lowongan.update', $job) }}" method="POST">
        @csrf
        @method('PUT')
        @include('jobs._form', ['job' => $job])
        <div class="mt-6 flex flex-wrap gap-3">
            <button class="btn-primary">Perbarui</button>
            <a href="{{ route('employer.dashboard') }}" class="btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
