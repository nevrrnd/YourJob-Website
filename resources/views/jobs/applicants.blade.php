@extends('layouts.dashboard', ['title' => 'Kelola Pelamar'])

@section('content')
<div>
    <x-page-header title="Pelamar: {{ $job->title }}" subtitle="{{ $applications->count() }} pelamar masuk">
        <a href="{{ route('employer.dashboard') }}" class="btn-ghost btn-sm">← Dashboard</a>
    </x-page-header>

    @if ($applications->isEmpty())
        <div class="card">
            <x-empty-state icon="👥" title="Belum ada pelamar">Bagikan lowongan kamu agar lebih banyak kandidat melamar.</x-empty-state>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($applications as $app)
                <div class="card card-hover p-5">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="grid place-items-center w-12 h-12 rounded-full bg-brand-gradient text-white font-bold shrink-0">{{ strtoupper(substr($app->seeker->name, 0, 1)) }}</div>
                            <div>
                                <p class="font-bold text-ink-900">{{ $app->seeker->name }}</p>
                                <p class="text-sm text-ink-500">✉️ {{ $app->seeker->email }}</p>
                                @if ($app->seeker->seekerProfile?->phone)
                                    <p class="text-sm text-ink-500">📞 {{ $app->seeker->seekerProfile->phone }}</p>
                                @endif
                                <p class="text-xs text-ink-400 mt-1">🕒 Melamar {{ $app->created_at->diffForHumans() }}</p>
                                @if ($app->cover_letter)
                                    <details class="mt-2 text-sm text-ink-600">
                                        <summary class="cursor-pointer text-brand-600 font-medium">Lihat cover letter</summary>
                                        <p class="mt-1 whitespace-pre-line bg-ink-50 rounded-lg p-3">{{ $app->cover_letter }}</p>
                                    </details>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-start sm:items-end gap-2 shrink-0">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $app->status_color }}">{{ $app->status_label }}</span>
                            <a href="{{ asset('storage/' . $app->cv_file) }}" target="_blank" class="btn-ghost btn-sm">📄 Lihat CV</a>
                        </div>
                    </div>

                    <form action="{{ route('employer.application.status', $app) }}" method="POST" class="mt-4 pt-4 border-t border-ink-100 grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-xs font-semibold text-ink-600 mb-1.5">Ubah Status</label>
                            <select name="status" class="field text-sm">
                                @foreach (['pending'=>'Menunggu','reviewed'=>'Ditinjau','interview'=>'Interview','accepted'=>'Diterima','rejected'=>'Ditolak'] as $val => $label)
                                    <option value="{{ $val }}" @selected($app->status === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-ink-600 mb-1.5">Catatan untuk Pelamar</label>
                            <div class="flex gap-2">
                                <input type="text" name="employer_note" value="{{ $app->employer_note }}" placeholder="Tulis catatan..." class="field text-sm flex-1">
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
