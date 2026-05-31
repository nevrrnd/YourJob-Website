<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    public const CACHE_KEY = 'app.settings.all';

    /**
     * All settings as a key => value map (cached).
     *
     * @return array<string, mixed>
     */
    public static function all(...$args): array
    {
        // Allow Eloquent's all() signature but return a cached key/value map.
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    /**
     * Get a single setting value with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = static::all()[$key] ?? $default;

        // Normalise common boolean-ish strings.
        if ($value === '1' || $value === 'true') {
            return true;
        }
        if ($value === '0' || $value === 'false') {
            return false;
        }

        return $value;
    }

    /**
     * Persist a single setting and bust the cache.
     */
    public static function put(string $key, mixed $value): void
    {
        if (is_bool($value)) {
            $value = $value ? '1' : '0';
        }

        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget(self::CACHE_KEY);
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
