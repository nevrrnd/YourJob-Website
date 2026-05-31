<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CompanyProfile;
use App\Models\SeekerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ---- Seeker profile ----

    public function seekerEdit(Request $request): View
    {
        $profile = $request->user()->seekerProfile
            ?? SeekerProfile::create(['user_id' => $request->user()->id]);

        return view('dashboard.profile', ['user' => $request->user(), 'profile' => $profile]);
    }

    public function seekerUpdate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();
        $user->update(['name' => $data['name']]);

        $profile = $user->seekerProfile ?? new SeekerProfile(['user_id' => $user->id]);
        $profile->phone = $data['phone'] ?? null;
        $profile->city = $data['city'] ?? null;
        $profile->bio = $data['bio'] ?? null;
        $profile->skills = ! empty($data['skills'])
            ? array_values(array_filter(array_map('trim', explode(',', $data['skills']))))
            : null;

        if ($request->hasFile('cv_file')) {
            $profile->cv_file = $request->file('cv_file')->store('cv', 'public');
        }
        if ($request->hasFile('avatar')) {
            $profile->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->save();

        return Redirect::route('seeker.profile')->with('success', 'Profil diperbarui.');
    }

    // ---- Employer profile ----

    public function employerEdit(Request $request): View
    {
        $profile = $request->user()->companyProfile
            ?? CompanyProfile::create([
                'user_id' => $request->user()->id,
                'company_name' => $request->user()->name,
                'slug' => Str::slug($request->user()->name) . '-' . uniqid(),
            ]);

        return view('dashboard.profile', ['user' => $request->user(), 'profile' => $profile]);
    }

    public function employerUpdate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();
        $profile = $user->companyProfile ?? new CompanyProfile([
            'user_id' => $user->id,
            'slug' => Str::slug($data['company_name']) . '-' . uniqid(),
        ]);

        $profile->company_name = $data['company_name'];
        $profile->industry = $data['industry'] ?? null;
        $profile->city = $data['city'] ?? null;
        $profile->description = $data['description'] ?? null;

        if ($request->hasFile('logo')) {
            $profile->logo = $request->file('logo')->store('logos', 'public');
        }

        $profile->save();

        return Redirect::route('employer.profile')->with('success', 'Profil perusahaan diperbarui.');
    }
}
