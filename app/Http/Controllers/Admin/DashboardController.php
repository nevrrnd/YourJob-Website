<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'seekers' => User::where('role', 'seeker')->count(),
            'employers' => User::where('role', 'employer')->count(),
            'jobs' => Job::count(),
            'active_jobs' => Job::where('status', 'active')->count(),
            'applications' => Application::count(),
            'companies' => CompanyProfile::count(),
            'pending_companies' => CompanyProfile::where('is_verified', false)->count(),
        ];

        $recentJobs = Job::with(['employer.companyProfile', 'category'])->latest()->limit(5)->get();

        // Aggregasi per kategori (JOIN + COUNT)
        $categoryStats = \App\Models\Category::select('categories.*')
            ->selectRaw('COUNT(DISTINCT jobs.id) as total_jobs')
            ->selectRaw('COUNT(DISTINCT applications.id) as total_applications')
            ->leftJoin('jobs', 'jobs.category_id', '=', 'categories.id')
            ->leftJoin('applications', 'applications.job_id', '=', 'jobs.id')
            ->groupBy('categories.id')
            ->orderByDesc('total_jobs')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentJobs', 'categoryStats'));
    }
}
