<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\SeekerProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: Str::before($googleUser->getEmail(), '@'),
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => Hash::make(Str::random(32)),
                'role' => 'seeker',
            ]);

            session(['needs_onboarding' => true]);
        }

        Auth::login($user, true);

        if (session('needs_onboarding')) {
            return redirect()->route('google.onboarding');
        }

        return redirect()->intended(route('dashboard'));
    }

    public function onboarding()
    {
        return view('auth.google-onboarding');
    }

    public function completeOnboarding(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', 'in:seeker,employer'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'company_name' => ['required_if:role,employer', 'nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = $request->user();
        $user->update(['role' => $validated['role']]);

        if ($validated['role'] === 'employer') {
            $user->seekerProfile()?->delete();
            CompanyProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'company_name' => $validated['company_name'],
                    'slug' => Str::slug($validated['company_name']) . '-' . $user->id,
                    'industry' => $validated['industry'] ?? null,
                    'city' => $validated['city'] ?? null,
                    'description' => $validated['description'] ?? null,
                ]
            );
        } else {
            $user->companyProfile()?->delete();
            SeekerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $validated['phone'] ?? null,
                    'city' => $validated['city'] ?? null,
                    'bio' => $validated['bio'] ?? null,
                ]
            );
        }

        session()->forget('needs_onboarding');

        return redirect()->route('dashboard')->with('success', 'Profil berhasil dilengkapi.');
    }
}
