@extends('layouts.dashboard', ['title' => __('Preferensi')])

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('preferences.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card p-6">
            <h2 class="section-title">{{ __('Tampilan & Bahasa') }}</h2>
            <p class="mt-1 text-sm text-[#737688]">{{ __('Pilih bahasa tampilan yang kamu inginkan.') }}</p>

            <div class="mt-5">
                <label class="mb-2 block text-sm font-bold text-[#434656]">{{ __('Bahasa') }}</label>
                <div class="grid grid-cols-2 gap-3">
                    @php
                        $langMeta = [
                            'id' => ['label' => __('Indonesia'), 'sub' => 'Bahasa Indonesia'],
                            'en' => ['label' => __('Inggris'), 'sub' => 'English'],
                        ];
                        $currentLang = old('language', $user->language ?? 'id');
                    @endphp
                    @foreach ($langMeta as $code => $meta)
                        <label class="flex cursor-pointer items-center gap-3 rounded-2xl border-2 border-slate-200 p-4 transition hover:border-blue-300 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                            <input type="radio" name="language" value="{{ $code }}" class="sr-only" @checked($currentLang === $code)>
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-white font-extrabold text-blue-600 ring-1 ring-slate-200">{{ strtoupper($code) }}</span>
                            <span>
                                <span class="block text-sm font-bold text-slate-950">{{ $meta['label'] }}</span>
                                <span class="block text-xs text-slate-500">{{ $meta['sub'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('language')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="mt-5">
                <label class="mb-1.5 block text-sm font-bold text-[#434656]">{{ __('Zona Waktu') }}</label>
                <select name="timezone" class="field">
                    @foreach ($timezones as $tz => $label)
                        <option value="{{ $tz }}" @selected(old('timezone', $user->timezone ?? 'Asia/Jakarta') === $tz)>{{ $label }}</option>
                    @endforeach
                </select>
                <p class="mt-1.5 text-xs text-[#737688]">{{ __('Digunakan untuk menampilkan tanggal & waktu.') }}</p>
                @error('timezone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="card p-6">
            <h2 class="section-title">{{ __('Notifikasi') }}</h2>
            <label class="mt-4 flex cursor-pointer items-start gap-3">
                <span class="relative mt-0.5 inline-flex shrink-0">
                    <input type="hidden" name="email_notifications" value="0">
                    <input type="checkbox" name="email_notifications" value="1" class="peer sr-only" @checked(old('email_notifications', $user->email_notifications ?? true))>
                    <span class="h-6 w-11 rounded-full bg-[#c3c5d9] transition-colors peer-checked:bg-[#003ec7]"></span>
                    <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                </span>
                <span>
                    <span class="block text-sm font-bold text-[#1a1c1e]">{{ __('Notifikasi Email') }}</span>
                    <span class="block text-xs text-[#737688]">{{ __('Terima email tentang lamaran dan pembaruan akun.') }}</span>
                </span>
            </label>
        </div>

        <div class="flex gap-3">
            <button class="btn-primary">{{ __('Simpan Perubahan') }}</button>
            <a href="{{ route('dashboard') }}" class="btn-ghost">{{ __('Batal') }}</a>
        </div>
    </form>
</div>
@endsection
