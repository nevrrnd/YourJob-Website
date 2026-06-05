<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserPreferenceController extends Controller
{
    /**
     * Common timezones offered in the preferences form.
     *
     * @var array<string, string>
     */
    public const TIMEZONES = [
        'Asia/Jakarta'   => 'WIB — Jakarta (GMT+7)',
        'Asia/Makassar'  => 'WITA — Makassar (GMT+8)',
        'Asia/Jayapura'  => 'WIT — Jayapura (GMT+9)',
        'Asia/Singapore' => 'Singapore (GMT+8)',
        'Asia/Kuala_Lumpur' => 'Kuala Lumpur (GMT+8)',
        'UTC'            => 'UTC (GMT+0)',
    ];

    public function edit(Request $request): View
    {
        return view('preferences', [
            'user' => $request->user(),
            'languages' => [
                'id' => __('Indonesia'),
                'en' => __('Inggris'),
            ],
            'timezones' => self::TIMEZONES,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'language' => ['required', 'in:' . implode(',', SetLocale::SUPPORTED)],
            'timezone' => ['required', 'in:' . implode(',', array_keys(self::TIMEZONES))],
            'email_notifications' => ['nullable', 'boolean'],
        ]);

        $request->user()->update([
            'language' => $data['language'],
            'timezone' => $data['timezone'],
            'email_notifications' => $request->boolean('email_notifications'),
        ]);

        // Keep guest-session locale in sync too (used before next request resolves user).
        $request->session()->put('locale', $data['language']);
        App::setLocale($data['language']);

        return back()->with('success', __('Preferensi berhasil disimpan.'));
    }
}
