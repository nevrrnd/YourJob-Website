@props(['color' => 'gray'])
@php
    $map = [
        'gray'   => 'bg-white/80 text-ink-600 border border-ink-200',
        'brand'  => 'bg-[#2c7da0]/10 text-[#155e75] border border-[#2c7da0]/20',
        'green'  => 'bg-green-100 text-green-700',
        'amber'  => 'bg-amber-100 text-amber-700',
        'red'    => 'bg-red-100 text-red-700',
        'violet' => 'bg-violet-100 text-violet-700',
        'sky'    => 'bg-sky-100 text-sky-700',
    ];
    $classes = $map[$color] ?? $map['gray'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 text-xs font-bold px-3 py-1.5 rounded-full ' . $classes]) }}>
    {{ $slot }}
</span>
