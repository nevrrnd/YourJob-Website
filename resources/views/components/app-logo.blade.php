@props([
    'size' => 32,        // mark size in px
    'wordmark' => true,  // show "YourJob" text
    'invert' => false,   // light wordmark for dark backgrounds
])
@php
    $gid = 'yjg-' . uniqid();
    $textBase = $invert ? 'text-white' : 'text-ink-900';
    $textAccent = $invert ? 'text-brand-200' : 'text-brand-600';
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 font-bold leading-none select-none']) }}>
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 40 40" fill="none"
         xmlns="http://www.w3.org/2000/svg" class="shrink-0" role="img" aria-label="YourJob">
        <defs>
            <linearGradient id="{{ $gid }}" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                <stop stop-color="#3b82f6"/>
                <stop offset="1" stop-color="#1d4ed8"/>
            </linearGradient>
        </defs>
        <rect width="40" height="40" rx="10" fill="url(#{{ $gid }})"/>
        <!-- briefcase handle -->
        <path d="M15.5 15V13.2a4.5 4.5 0 0 1 9 0V15" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/>
        <!-- briefcase body -->
        <rect x="9" y="15.5" width="22" height="14.5" rx="3.2" fill="#fff"/>
        <!-- opening band -->
        <rect x="9" y="21.4" width="22" height="2.2" fill="#bfdbfe"/>
        <!-- center clasp -->
        <rect x="17.4" y="19.6" width="5.2" height="5.2" rx="1.4" fill="#1d4ed8"/>
    </svg>
    @if ($wordmark)
        <span class="{{ $textBase }}">Your<span class="{{ $textAccent }}">Job</span></span>
    @endif
</span>
