@extends('layouts.dashboard', ['title' => 'Posting Lowongan'])

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-3xl font-extrabold text-[#1a1c1e]">Posting Lowongan Baru</h2>
        <p class="mt-2 text-[#737688]">Lengkapi detail lowongan agar menarik kandidat terbaik.</p>
    </div>
    <form action="{{ route('employer.lowongan.store') }}" method="POST">
        @csrf
        @include('jobs._form')
        <div class="mt-6 flex flex-wrap gap-3">
            <button class="btn-primary">Simpan Lowongan</button>
            <a href="{{ route('employer.dashboard') }}" class="btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
