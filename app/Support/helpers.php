<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Read an application setting with an optional default.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        try {
            return Setting::get($key, $default);
        } catch (\Throwable $e) {
            // Settings table may not exist yet (e.g. before migration).
            return $default;
        }
    }
}

if (! function_exists('site_logo_url')) {
    /**
     * Resolve the configured site logo, falling back to the bundled logo.
     */
    function site_logo_url(): string
    {
        $logo = setting('site_logo');

        return $logo ? asset('storage/' . $logo) : asset('logo.png');
    }
}
