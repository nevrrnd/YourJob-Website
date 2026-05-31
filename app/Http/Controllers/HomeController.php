<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'latestJobs' => Job::with(['employer.companyProfile', 'category'])
                ->active()->latest()->limit(8)->get(),
            'categories' => Category::withCount(['jobs' => fn ($q) => $q->active()])->get(),
            'stats' => [
                'jobs' => Job::active()->count(),
                'companies' => CompanyProfile::where('is_verified', true)->count(),
                'seekers' => \App\Models\User::where('role', 'seeker')->count(),
            ],
        ];

        return view('home.index', $data);
    }

    public function jobs(Request $request)
    {
        $jobs = Job::with(['employer.companyProfile', 'category'])
            ->active()
            ->filter($request)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('home.jobs', compact('jobs', 'categories'));
    }

    public function show(Job $job)
    {
        abort_if($job->status !== 'active' && (! auth()->check() || auth()->id() !== $job->employer_id), 404);

        $job->load(['employer.companyProfile', 'category']);
        $job->increment('view_count');

        $hasApplied = false;
        $isSaved = false;

        if (auth()->check() && auth()->user()->isSeeker()) {
            $hasApplied = Application::where('job_id', $job->id)
                ->where('seeker_id', auth()->id())->exists();
            $isSaved = auth()->user()->savedJobs()->where('jobs.id', $job->id)->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied', 'isSaved'));
    }
}
