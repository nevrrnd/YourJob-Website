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
        $recentApplications = (clone $applicationQuery)
            ->with(['job', 'seeker'])
            ->latest()
            ->limit(6)
            ->get();

        $currentWeekApplications = (clone $applicationQuery)
            ->where('created_at', '>=', now()->copy()->subDays(7))
            ->count();
        $previousWeekApplications = (clone $applicationQuery)
            ->whereBetween('created_at', [now()->copy()->subDays(14), now()->copy()->subDays(7)])
            ->count();

        $stats = [
            'active_jobs' => $jobs->where('status', 'active')->count(),
            'jobs_this_week' => $jobs->where('created_at', '>=', now()->copy()->startOfWeek())->count(),
            'total_applicants' => (clone $applicationQuery)->count(),
            'applicants_today' => (clone $applicationQuery)->whereDate('created_at', today())->count(),
            'interview' => (clone $applicationQuery)->where('status', 'interview')->count(),
            'accepted' => (clone $applicationQuery)->where('status', 'accepted')->count(),
        ];

        $applicationTrend = $previousWeekApplications > 0
            ? round((($currentWeekApplications - $previousWeekApplications) / $previousWeekApplications) * 100)
            : ($currentWeekApplications > 0 ? 100 : 0);

        return view('dashboard.employer', compact('jobs', 'stats', 'recentApplications', 'applicationTrend'));
    }
}
