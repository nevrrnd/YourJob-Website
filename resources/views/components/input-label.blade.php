@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-1.5 block text-sm font-bold text-[#434656]']) }}>
    {{ $value ?? $slot }}
</label>
