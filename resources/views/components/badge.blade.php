@props(['color' => 'gray'])
@php
    $map = [
        'gray'   => 'bg-[#f7f8f9] text-[#434656] border border-[#e5e7eb]',
        'brand'  => 'bg-[#dde1ff] text-[#001452] border border-[#b7c4ff]',
        'green'  => 'bg-green-100 text-green-700 border border-green-200',
        'amber'  => 'bg-amber-100 text-amber-800 border border-amber-200',
        'red'    => 'bg-red-100 text-red-700 border border-red-200',
        'violet' => 'bg-[#eedcff] text-[#523d6e] border border-[#dfc4fe]',
        'sky'    => 'bg-[#dde1ff] text-[#0038b6] border border-[#b7c4ff]',
    ];
    $classes = $map[$color] ?? $map['gray'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-full px-3 py-1.5 text-xs font-bold ' . $classes]) }}>
    {{ $slot }}
</span>
