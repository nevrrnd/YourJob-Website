@props(['color' => 'gray'])
@php
    $map = [
        'gray'   => 'bg-white/70 text-slate-600 border border-white/60',
        'brand'  => 'bg-blue-50 text-blue-700 border border-blue-100',
        'green'  => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
        'amber'  => 'bg-amber-50 text-amber-800 border border-amber-100',
        'red'    => 'bg-red-50 text-red-700 border border-red-100',
        'violet' => 'bg-violet-accent/10 text-violet-accent border border-violet-accent/20',
        'sky'    => 'bg-blue-50 text-blue-700 border border-blue-100',
    ];
    $classes = $map[$color] ?? $map['gray'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-full px-3 py-1.5 text-xs font-bold ' . $classes]) }}>
    {{ $slot }}
</span>
