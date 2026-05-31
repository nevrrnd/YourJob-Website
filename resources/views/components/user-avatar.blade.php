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

    // Fallback initial + role-based background color
    $initial = strtoupper(mb_substr($user?->name ?? '?', 0, 1));
    $bg = match ($user?->role) {
        'seeker'   => 'bg-emerald-600',
        'employer' => 'bg-orange-500',
        'admin'    => 'bg-indigo-600',
        default    => 'bg-ink-500',
    };
@endphp
@if ($photo)
    <img src="{{ asset('storage/' . $photo) }}" alt="{{ $user?->name }}"
         {{ $attributes->merge(['class' => 'w-8 h-8 rounded-full object-cover ring-1 ring-ink-200']) }}>
@else
    <span {{ $attributes->merge(['class' => 'grid place-items-center w-8 h-8 rounded-full text-white text-xs font-semibold ' . $bg]) }}>
        {{ $initial }}
    </span>
@endif
