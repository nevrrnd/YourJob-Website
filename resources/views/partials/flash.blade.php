@php
    $flashes = [
        'success' => ['label' => 'OK', 'ring' => 'border-green-200 bg-green-50/95 text-green-800'],
        'warning' => ['label' => '!', 'ring' => 'border-amber-200 bg-amber-50/95 text-amber-800'],
        'error'   => ['label' => 'ERR', 'ring' => 'border-red-200 bg-red-50/95 text-red-800'],
        'status'  => ['label' => 'INFO', 'ring' => 'border-sky-200 bg-sky-50/95 text-sky-800'],
    ];
    $hasFlash = collect(array_keys($flashes))->contains(fn ($k) => session($k));
@endphp

@if ($hasFlash)
    <div class="fixed top-24 right-4 z-50 w-full max-w-sm space-y-3 px-4 sm:px-0">
        @foreach ($flashes as $key => $meta)
            @if (session($key))
                <div x-data="{ show: true }" x-show="show" x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-end="opacity-0 translate-x-8"
                     x-init="setTimeout(() => show = false, 5000)"
                     class="flex items-start gap-3 backdrop-blur-xl border rounded-2xl shadow-lift px-4 py-3 text-sm {{ $meta['ring'] }}">
                    <span class="grid h-7 min-w-7 place-items-center rounded-full bg-white/70 text-[10px] font-extrabold">{{ $meta['label'] }}</span>
                    <span class="flex-1 font-semibold">{{ session($key) }}</span>
                    <button type="button" @click="show = false" class="text-lg leading-none opacity-60 hover:opacity-100">&times;</button>
                </div>
            @endif
        @endforeach
    </div>
@endif

@if ($errors->any() && ! request()->routeIs('register', 'login', 'password.*'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="card border-red-200 bg-red-50/90 px-4 py-3 text-sm text-red-800">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
