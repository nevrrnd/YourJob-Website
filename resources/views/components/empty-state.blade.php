@props(['icon' => '📭', 'title' => 'Belum ada data'])
<div {{ $attributes->merge(['class' => 'p-12 text-center']) }}>
    <div class="mx-auto grid place-items-center w-16 h-16 rounded-2xl bg-brand-50 text-3xl mb-4">{{ $icon }}</div>
    <p class="font-bold text-ink-800">{{ $title }}</p>
    @if (trim($slot) !== '')
        <p class="text-sm text-ink-500 mt-1">{{ $slot }}</p>
    @endif
</div>
