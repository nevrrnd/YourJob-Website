<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'employer' => redirect()->route('employer.dashboard'),
            default => redirect()->route('seeker.dashboard'),
        };
    }

    public function seeker()
    {
        $applications = Application::with(['job.employer.companyProfile'])
            ->where('seeker_id', auth()->id())
            ->latest()
            ->get();

        $stats = [
            'total' => $applications->count(),
            'pending' => $applications->where('status', 'pending')->count(),
            'interview' => $applications->where('status', 'interview')->count(),
            'accepted' => $applications->where('status', 'accepted')->count(),
        ];

        return view('dashboard.seeker', compact('applications', 'stats'));
    }

    public function employer()
    {
        $employerId = auth()->id();

        $jobs = Job::withCount('applications')
            ->where('employer_id', $employerId)
            ->latest()
            ->get();

        $applicationQuery = Application::whereHas('job', fn ($q) => $q->where('employer_id', $employerId));

        $stats = [
            'active_jobs' => $jobs->where('status', 'active')->count(),
            'total_applicants' => (clone $applicationQuery)->count(),
            'interview' => (clone $applicationQuery)->where('status', 'interview')->count(),
            'accepted' => (clone $applicationQuery)->where('status', 'accepted')->count(),
        ];

        return view('dashboard.employer', compact('jobs', 'stats'));
    }
}
