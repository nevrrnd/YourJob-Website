@props(['label' => '', 'value' => '', 'icon' => 'analytics', 'grad' => ''])
<div {{ $attributes->merge(['class' => 'glass-panel group relative overflow-hidden rounded-2xl p-4 sm:p-6']) }}>
    <div class="absolute right-0 top-0 h-28 w-28 translate-x-10 -translate-y-10 rounded-full bg-blue-600/10 blur-xl transition group-hover:bg-violet-accent/15"></div>
    <div class="relative flex items-center justify-between gap-3">
        <div class="min-w-0">
            <div class="truncate text-xs font-bold leading-5 text-slate-500 sm:text-sm">{{ $label }}</div>
            <div class="mt-1 text-3xl font-extrabold leading-tight text-slate-950 sm:mt-2 sm:text-4xl">{{ $value }}</div>
        </div>
        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-blue-50 text-blue-600 sm:h-12 sm:w-12">
            <span class="material-symbols-outlined text-[20px] sm:text-[24px]">{{ is_numeric($icon) ? 'analytics' : $icon }}</span>
        </div>
    </div>
</div>
