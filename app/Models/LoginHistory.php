<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LoginHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'device_type',
        'device_name',
        'browser',
        'platform',
        'user_agent',
        'logged_in_at',
    ];

    protected function casts(): array
    {
        return [
            'logged_in_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function recordAdminLogin(Request $request, User $user): void
    {
        if (! $user->isAdmin()) {
            return;
        }

        $userAgent = (string) $request->userAgent();
        $device = self::parseUserAgent($userAgent);

        self::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'device_type' => $device['type'],
            'device_name' => $device['name'],
            'browser' => $device['browser'],
            'platform' => $device['platform'],
            'user_agent' => $userAgent,
            'logged_in_at' => now(),
        ]);
    }

    protected static function parseUserAgent(string $userAgent): array
    {
        $ua = strtolower($userAgent);

        $platform = match (true) {
            str_contains($ua, 'windows') => 'Windows',
            str_contains($ua, 'android') => 'Android',
            str_contains($ua, 'iphone') => 'iPhone / iOS',
            str_contains($ua, 'ipad') => 'iPad / iPadOS',
            str_contains($ua, 'mac os') || str_contains($ua, 'macintosh') => 'macOS',
            str_contains($ua, 'linux') => 'Linux',
            default => 'Unknown OS',
        };

        $browser = match (true) {
            str_contains($ua, 'edg/') || str_contains($ua, 'edge/') => 'Microsoft Edge',
            str_contains($ua, 'opr/') || str_contains($ua, 'opera') => 'Opera',
            str_contains($ua, 'firefox/') => 'Firefox',
            str_contains($ua, 'chrome/') || str_contains($ua, 'crios/') => 'Chrome',
            str_contains($ua, 'safari/') => 'Safari',
            default => 'Unknown Browser',
        };

        $type = match (true) {
            str_contains($ua, 'bot') || str_contains($ua, 'crawler') || str_contains($ua, 'spider') => 'Bot',
            str_contains($ua, 'ipad') || str_contains($ua, 'tablet') => 'Tablet',
            str_contains($ua, 'mobile') || str_contains($ua, 'iphone') || str_contains($ua, 'android') => 'Mobile',
            default => 'Desktop',
        };

        return [
            'type' => $type,
            'platform' => $platform,
            'browser' => $browser,
            'name' => trim("{$type} - {$browser} on {$platform}"),
        ];
    }
}
