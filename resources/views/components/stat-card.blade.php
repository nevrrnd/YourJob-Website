@props(['label' => '', 'value' => '', 'icon' => 'analytics', 'grad' => ''])
<div {{ $attributes->merge(['class' => 'card card-hover relative overflow-hidden p-4 sm:p-6']) }}>
    <div class="absolute right-0 top-0 h-28 w-28 translate-x-10 -translate-y-10 rounded-full bg-[#003ec7]/5"></div>
    <div class="relative flex items-center justify-between gap-3">
        <div class="min-w-0">
            <div class="truncate text-xs font-semibold leading-5 text-[#737688] sm:text-sm">{{ $label }}</div>
            <div class="mt-1 text-3xl font-extrabold leading-tight text-[#1a1c1e] sm:mt-2 sm:text-4xl">{{ $value }}</div>
        </div>
        <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-[#dde1ff] text-[#003ec7] sm:h-12 sm:w-12">
            <span class="material-symbols-outlined text-[20px] sm:text-[24px]">{{ is_numeric($icon) ? 'analytics' : $icon }}</span>
        </div>
    </div>
</div>
