@props(['icon' => '', 'title' => 'Belum ada data'])

<div {{ $attributes->merge(['class' => 'p-12 text-center']) }}>
    <div class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-2xl bg-blue-50 text-blue-600">
        <span class="material-symbols-outlined">{{ $icon ?: 'inbox' }}</span>
    </div>
    <p class="font-extrabold text-slate-950">{{ $title }}</p>
    @if (trim($slot) !== '')
        <p class="mt-1 text-sm text-slate-600">{{ $slot }}</p>
    @endif
</div>
