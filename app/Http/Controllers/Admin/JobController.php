<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::with(['employer.companyProfile', 'category'])
            ->withCount('applications')
            ->when($request->q, fn ($q) => $q->where('title', 'like', "%{$request->q}%"))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.jobs', compact('jobs'));
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return back()->with('success', 'Lowongan dihapus.');
    }
}
