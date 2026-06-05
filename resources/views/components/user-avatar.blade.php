@props(['user' => null])
@php
    $user = $user ?? auth()->user();

    // Resolve profile photo by role: seeker -> avatar, employer -> logo
    $photo = null;
    if ($user) {
        if ($user->isSeeker()) {
            $photo = $user->seekerProfile?->avatar;
        } elseif ($user->isEmployer()) {
            $photo = $user->companyProfile?->logo;
        }
    }

    $initial = strtoupper(mb_substr($user?->name ?? '?', 0, 1));
@endphp
@if ($photo)
    <img src="{{ asset('storage/' . $photo) }}" alt="{{ $user?->name }}"
         {{ $attributes->merge(['class' => 'h-8 w-8 rounded-full object-cover ring-1 ring-[#e5e7eb]']) }}>
@else
    <span {{ $attributes->merge(['class' => 'grid h-8 w-8 place-items-center rounded-full bg-[#003ec7] text-xs font-extrabold text-white shadow-sm']) }}>
        {{ $initial }}
    </span>
@endif
