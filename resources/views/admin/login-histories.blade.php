@extends('layouts.dashboard', ['title' => 'Riwayat Login Admin'])

@section('content')
<div class="card overflow-hidden">
    <div class="flex flex-col justify-between gap-3 border-b border-[#e5e7eb] px-6 py-5 sm:flex-row sm:items-center">
        <div>
            <h2 class="font-bold text-[#1a1c1e]">Device Login Administrator</h2>
            <p class="mt-1 text-sm text-slate-500">Pantau perangkat, browser, IP, dan waktu login akun admin.</p>
        </div>
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari admin/device/IP" class="field !w-auto text-sm">
            <button class="btn-primary btn-sm">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Administrator</th>
                    <th>Device</th>
                    <th>Browser / OS</th>
                    <th>IP Address</th>
                    <th>Waktu Login</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($histories as $history)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="grid h-9 w-9 place-items-center rounded-full bg-violet-100 text-xs font-bold text-violet-700">
                                    {{ strtoupper(substr($history->user?->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-[#1a1c1e]">{{ $history->user?->name ?? 'Admin terhapus' }}</div>
                                    <div class="text-xs text-slate-500">{{ $history->user?->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <x-badge :color="$history->device_type === 'Mobile' ? 'sky' : ($history->device_type === 'Tablet' ? 'brand' : 'violet')">
                                {{ $history->device_type ?? 'Unknown' }}
                            </x-badge>
                            <div class="mt-1 text-xs text-slate-500">{{ $history->device_name ?? '-' }}</div>
                        </td>
                        <td class="text-slate-700">
                            <div class="font-semibold">{{ $history->browser ?? '-' }}</div>
                            <div class="text-xs text-slate-500">{{ $history->platform ?? '-' }}</div>
                        </td>
                        <td class="font-mono text-xs text-slate-600">{{ $history->ip_address ?? '-' }}</td>
                        <td>
                            <div class="font-semibold text-slate-800">{{ $history->logged_in_at?->format('d M Y H:i') }}</div>
                            <div class="text-xs text-slate-500">{{ $history->logged_in_at?->diffForHumans() }}</div>
                        </td>
                        <td class="max-w-xs">
                            <span class="block truncate text-xs text-slate-500" title="{{ $history->user_agent }}">{{ $history->user_agent ?: '-' }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"><x-empty-state icon="devices" title="Belum ada riwayat login admin" /></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4">{{ $histories->links() }}</div>
</div>
@endsection
