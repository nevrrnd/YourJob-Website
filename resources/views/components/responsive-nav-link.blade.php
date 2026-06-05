@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#003ec7] text-start text-base font-bold text-[#003ec7] bg-[#dde1ff] focus:outline-none transition'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold text-[#434656] hover:text-[#003ec7] hover:bg-[#dde1ff]/60 hover:border-[#003ec7]/40 focus:outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
