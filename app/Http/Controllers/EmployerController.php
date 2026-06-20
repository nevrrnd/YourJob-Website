<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $employers = CompanyProfile::query()
            ->with('user')
            ->withCount(['jobs as active_jobs_count' => fn ($query) => $query->where('status', 'active')])
            ->whereHas('user', fn ($query) => $query->where('role', 'employer')->where('is_active', true))
            ->when($request->q, fn ($query, $q) => $query->where(function ($query) use ($q) {
                $query->where('company_name', 'like', "%{$q}%")
                    ->orWhere('industry', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            }))
            ->when($request->industry, fn ($query, $industry) => $query->where('industry', 'like', "%{$industry}%"))
            ->when($request->city, fn ($query, $city) => $query->where('city', 'like', "%{$city}%"))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $industries = CompanyProfile::query()
            ->whereNotNull('industry')
            ->pluck('industry')
            ->filter()
            ->unique()
            ->values();

        $cities = CompanyProfile::query()
            ->whereNotNull('city')
            ->pluck('city')
            ->filter()
            ->unique()
            ->values();

        return view('employers.index', compact('employers', 'industries', 'cities'));
    }

    public function show(string $username)
    {
        $employer = $this->resolveEmployer($username);

        abort_unless($employer, 404);

        $jobs = Job::with('category')
            ->where('employer_id', $employer->user_id)
            ->active()
            ->latest()
            ->get();

        return view('employers.show', compact('employer', 'jobs'));
    }

    private function resolveEmployer(string $username): ?CompanyProfile
    {
        $employer = CompanyProfile::with('user')
            ->where('slug', $username)
            ->whereHas('user', fn ($query) => $query->where('role', 'employer')->where('is_active', true))
            ->first();

        if ($employer) {
            return $employer;
        }

        if (preg_match('/-(\d+)$/', $username, $matches) || ctype_digit($username)) {
            $id = $matches[1] ?? $username;

            return CompanyProfile::with('user')
                ->where('user_id', $id)
                ->whereHas('user', fn ($query) => $query->where('role', 'employer')->where('is_active', true))
                ->first();
        }

        return CompanyProfile::with('user')
            ->whereHas('user', fn ($query) => $query->where('role', 'employer')->where('is_active', true))
            ->get()
            ->first(fn ($company) => Str::slug($company->company_name) === $username);
    }
}
