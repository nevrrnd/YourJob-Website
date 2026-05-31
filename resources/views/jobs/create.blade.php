@extends('layouts.dashboard', ['title' => 'Posting Lowongan'])

@section('content')
<div class="max-w-3xl">
    <x-page-header title="Posting Lowongan Baru" subtitle="Lengkapi detail lowongan agar menarik kandidat terbaik" />
    <form action="{{ route('employer.lowongan.store') }}" method="POST">
        @csrf
        @include('jobs._form')
        <div class="mt-6 flex gap-3">
            <button class="btn-primary">💾 Simpan Lowongan</button>
            <a href="{{ route('employer.dashboard') }}" class="btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
