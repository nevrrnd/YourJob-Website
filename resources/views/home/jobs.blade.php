@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl space-y-6 p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-950">Jobs</h1>
            <p class="text-sm text-slate-600">Explore current openings. {{ number_format($jobs->total()) }} lowongan tersedia.</p>
        </div>
    </div>

    <form action="{{ route('jobs.index') }}" method="GET" class="grid gap-3 rounded-3xl bg-white p-4 shadow-sm ring-1 ring-slate-200/75 sm:grid-cols-2 xl:grid-cols-5">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title, company, location" class="field text-sm xl:col-span-2">
        <input type="text" name="city" value="{{ request('city') }}" placeholder="Location" class="field text-sm">
        <select name="type" class="field text-sm">
            <option value="">Any Type</option>
            @foreach (['full_time'=>'Full Time','part_time'=>'Part Time','freelance'=>'Freelance','internship'=>'Magang','contract'=>'Kontrak'] as $val => $label)
                <option value="{{ $val }}" @selected(request('type') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-700">Search</button>
    </form>

    <div class="grid gap-4 lg:grid-cols-2">
        @forelse ($jobs as $job)
            @include('partials.job-card', ['job' => $job])
        @empty
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/75">
                <p class="text-sm text-slate-500">No jobs found.</p>
            </div>
        @endforelse
    </div>

    <div>{{ $jobs->links() }}</div>
</div>
@endsection
