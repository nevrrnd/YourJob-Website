@props(['icon' => '', 'title' => 'Belum ada data'])

<div {{ $attributes->merge(['class' => 'p-12 text-center']) }}>
    <div class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-xl bg-[#dde1ff] text-[#003ec7]">
        <span class="material-symbols-outlined">{{ $icon ?: 'inbox' }}</span>
    </div>
    <p class="font-extrabold text-[#1a1c1e]">{{ $title }}</p>
    @if (trim($slot) !== '')
        <p class="mt-1 text-sm text-[#434656]">{{ $slot }}</p>
    @endif
</div>
