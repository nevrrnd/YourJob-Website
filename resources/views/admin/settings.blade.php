@extends('layouts.dashboard', ['title' => 'Pengaturan Situs'])

@section('content')
<div x-data="{ tab: '{{ array_key_first($schema) }}' }" class="space-y-6">
    <!-- Tab nav -->
    <div class="section-panel flex flex-wrap gap-1 p-2">
        @foreach ($schema as $group => $section)
            <button type="button" @click="tab = '{{ $group }}'"
                    :class="tab === '{{ $group }}' ? 'bg-[#003ec7] text-white shadow-sm' : 'text-[#434656] hover:bg-white hover:text-[#003ec7]'"
                    class="rounded-lg px-4 py-2 text-sm font-bold transition">
                {{ $section['icon'] }} {{ $section['label'] }}
            </button>
        @endforeach
    </div>

    @foreach ($schema as $group => $section)
        <div x-show="tab === '{{ $group }}'" x-cloak>
            <form action="{{ route('admin.settings.update', $group) }}" method="POST" enctype="multipart/form-data" class="section-panel p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <h2 class="section-title">{{ $section['icon'] }} {{ $section['label'] }}</h2>
                </div>

                @foreach ($section['fields'] as $key => $field)
                    @php $value = $values[$key] ?? ''; @endphp
                    <div>
                        @if ($field['type'] === 'boolean')
                            <label class="flex items-start gap-3 cursor-pointer">
                                <span class="relative inline-flex shrink-0 mt-0.5">
                                    <input type="hidden" name="{{ $key }}" value="0">
                                    <input type="checkbox" name="{{ $key }}" value="1" class="peer sr-only"
                                           @checked($value === '1' || $value === 1 || $value === true)>
                                    <span class="h-6 w-11 rounded-full bg-[#c3c5d9] transition-colors peer-checked:bg-[#003ec7]"></span>
                                    <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                                </span>
                                <span>
                                    <span class="block text-sm font-bold text-[#1a1c1e]">{{ $field['label'] }}</span>
                                    @isset($field['hint'])<span class="block text-xs text-[#737688]">{{ $field['hint'] }}</span>@endisset
                                </span>
                            </label>
                        @else
                            <label class="mb-1.5 block text-sm font-bold text-[#434656]">{{ $field['label'] }}</label>
                            @if ($field['type'] === 'textarea')
                                <textarea name="{{ $key }}" rows="3" class="field">{{ old($key, $value) }}</textarea>
                            @elseif ($field['type'] === 'image')
                                @if ($value)
                                    <img src="{{ asset('storage/' . $value) }}" alt="logo" class="mb-2 h-12 rounded-lg border border-[#e5e7eb] bg-white p-1">
                                @endif
                                <input type="file" name="{{ $key }}" accept="image/*"
                                       class="block w-full text-sm text-[#737688] file:mr-3 file:cursor-pointer file:rounded-lg file:border-0 file:bg-[#003ec7] file:px-4 file:py-2 file:font-semibold file:text-white">
                            @else
                                <input type="{{ $field['type'] === 'number' ? 'number' : ($field['type'] === 'email' ? 'email' : 'text') }}"
                                       name="{{ $key }}" value="{{ old($key, $value) }}" class="field">
                            @endif
                            @isset($field['hint'])<p class="mt-1.5 text-xs text-[#737688]">{{ $field['hint'] }}</p>@endisset
                        @endif
                        @error($key)<p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>@enderror
                    </div>
                @endforeach

                <div class="pt-2">
                    <button class="btn-primary">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection
