@extends('layouts.dashboard', ['title' => 'Kelola Pelamar'])

@section('content')
<div>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-[#1a1c1e]">Pelamar: {{ $job->title }}</h2>
            <p class="mt-2 text-[#737688]">{{ $applications->count() }} pelamar masuk</p>
        </div>
        <a href="{{ route('employer.dashboard') }}" class="btn-ghost btn-sm">Dashboard</a>
    </div>

    @if ($applications->isEmpty())
        <div class="card">
            <x-empty-state icon="groups" title="Belum ada pelamar">Bagikan lowongan kamu agar lebih banyak kandidat melamar.</x-empty-state>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($applications as $app)
                <div class="card card-hover p-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-start gap-4">
                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#dde1ff] font-bold text-[#003ec7]">{{ strtoupper(substr($app->seeker->name, 0, 1)) }}</div>
                            <div>
                                <p class="font-bold text-[#1a1c1e]">{{ $app->seeker->name }}</p>
                                <p class="mt-1 flex items-center gap-2 text-sm text-[#737688]"><span class="material-symbols-outlined text-[16px]">mail</span>{{ $app->seeker->email }}</p>
                                @if ($app->seeker->seekerProfile?->phone)
                                    <p class="mt-1 flex items-center gap-2 text-sm text-[#737688]"><span class="material-symbols-outlined text-[16px]">call</span>{{ $app->seeker->seekerProfile->phone }}</p>
                                @endif
                                <p class="mt-1 flex items-center gap-2 text-xs text-[#737688]"><span class="material-symbols-outlined text-[15px]">schedule</span>Melamar {{ $app->created_at->diffForHumans() }}</p>
                                @if ($app->cover_letter)
                                    <details class="mt-3 text-sm text-[#434656]">
                                        <summary class="cursor-pointer font-bold text-[#003ec7]">Lihat cover letter</summary>
                                        <p class="mt-2 whitespace-pre-line rounded-lg bg-[#f7f8f9] p-3">{{ $app->cover_letter }}</p>
                                    </details>
                                @endif
                            </div>
                        </div>
                        <div class="flex shrink-0 flex-col items-start gap-2 sm:items-end">
                            <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $app->status_color }}">{{ $app->status_label }}</span>
                            <a href="{{ asset('storage/' . $app->cv_file) }}" target="_blank" class="btn-ghost btn-sm">
                                <span class="material-symbols-outlined text-[16px]">description</span>
                                Lihat CV
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('employer.application.status', $app) }}" method="POST" class="mt-5 grid grid-cols-1 items-end gap-3 border-t border-[#e5e7eb] pt-5 sm:grid-cols-3">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-[#737688]">Ubah Status</label>
                            <select name="status" class="field text-sm">
                                @foreach (['pending'=>'Menunggu','reviewed'=>'Ditinjau','interview'=>'Interview','accepted'=>'Diterima','rejected'=>'Ditolak'] as $val => $label)
                                    <option value="{{ $val }}" @selected($app->status === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-bold text-[#737688]">Catatan untuk Pelamar</label>
                            <div class="flex gap-2">
                                <input type="text" name="employer_note" value="{{ $app->employer_note }}" placeholder="Tulis catatan..." class="field flex-1 text-sm">
                                <button class="btn-primary btn-sm whitespace-nowrap">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
