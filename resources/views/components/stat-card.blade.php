@props(['label' => '', 'value' => '', 'icon' => '', 'grad' => 'from-[#1e4a6e] to-[#2c7da0]'])
<div {{ $attributes->merge(['class' => 'card card-hover p-5 relative overflow-hidden']) }}>
    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-[#2c7da0]/10"></div>
    <div class="relative grid place-items-center w-12 h-12 rounded-2xl bg-white text-[#2c7da0] text-lg shadow-soft">{{ $icon }}</div>
    <div class="relative mt-4 text-3xl font-extrabold text-ink-900">{{ $value }}</div>
    <div class="relative text-sm font-semibold text-ink-500">{{ $label }}</div>
</div>
