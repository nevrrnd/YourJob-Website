@props(['title' => '', 'subtitle' => null])
<div {{ $attributes->merge(['class' => 'section-panel p-6 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6']) }}>
    <div>
        <h2 class="text-2xl font-extrabold premium-heading">{{ $title }}</h2>
        @if ($subtitle)
            <p class="text-sm text-ink-500 mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    @if (trim($slot) !== '')
        <div class="flex items-center gap-2">{{ $slot }}</div>
    @endif
</div>
