<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeekerController extends Controller
{
    public function index(Request $request)
    {
        $seekers = User::query()
            ->with('seekerProfile')
            ->where('role', 'seeker')
            ->where('is_active', true)
            ->when($request->q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhereHas('seekerProfile', fn ($profile) => $profile
                            ->where('bio', 'like', "%{$q}%")
                            ->orWhere('skills', 'like', "%{$q}%"));
                });
            })
            ->when($request->city, fn ($query, $city) => $query->whereHas('seekerProfile', fn ($profile) => $profile->where('city', 'like', "%{$city}%")))
            ->when($request->skill, fn ($query, $skill) => $query->whereHas('seekerProfile', fn ($profile) => $profile->where('skills', 'like', "%{$skill}%")))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $profiles = User::query()
            ->with('seekerProfile')
            ->where('role', 'seeker')
            ->where('is_active', true)
            ->get()
            ->pluck('seekerProfile')
            ->filter();

        $skills = $profiles
            ->flatMap(fn ($profile) => is_array($profile->skills) ? $profile->skills : [])
            ->filter()
            ->unique()
            ->values();

        $cities = $profiles
            ->pluck('city')
            ->filter()
            ->unique()
            ->values();

        return view('seekers.index', compact('seekers', 'skills', 'cities'));
    }

    public function show(string $username)
    {
        $seeker = $this->resolveSeeker($username);

        abort_unless($seeker, 404);

        $applications = $seeker->applications()
            ->with(['job.employer.companyProfile'])
            ->latest()
            ->limit(5)
            ->get();

        return view('seekers.show', compact('seeker', 'applications'));
    }

    private function resolveSeeker(string $username): ?User
    {
        if (preg_match('/-(\d+)$/', $username, $matches) || ctype_digit($username)) {
            $id = $matches[1] ?? $username;

            return User::with('seekerProfile')
                ->where('role', 'seeker')
                ->where('is_active', true)
                ->find($id);
        }

        return User::with('seekerProfile')
            ->where('role', 'seeker')
            ->where('is_active', true)
            ->get()
            ->first(fn ($user) => Str::slug($user->name) === $username);
    }
}
