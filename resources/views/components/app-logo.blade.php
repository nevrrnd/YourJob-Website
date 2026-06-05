@props([
    'size' => 32,        // mark size in px
    'wordmark' => true,  // show "YourJob" text
    'invert' => false,   // light wordmark for dark backgrounds
])
@php
    $textBase = $invert ? 'text-white' : 'text-ink-900';
    $textAccent = $invert ? 'text-[#b7c4ff]' : 'text-[#003ec7]';
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 font-bold leading-none select-none']) }}>
    <img src="{{ asset('logo.png') }}" alt="YourJob"
         width="{{ $size }}" height="{{ $size }}"
         class="shrink-0 object-contain {{ $invert ? 'brightness-0 invert' : '' }}">
    @if ($wordmark)
        <span class="{{ $textBase }}">Your<span class="{{ $textAccent }}">Job</span></span>
    @endif
</span>
