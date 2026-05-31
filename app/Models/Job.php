<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'employer_id', 'category_id', 'title', 'slug', 'description',
        'requirements', 'benefits', 'type', 'location_type', 'city',
        'salary_min', 'salary_max', 'salary_visible', 'experience',
        'status', 'deadline', 'view_count',
    ];

    protected $casts = [
        'salary_visible' => 'boolean',
        'deadline' => 'date',
        'view_count' => 'integer',
    ];

    // ---- Relations ----

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs');
    }

    // ---- Route key ----

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // ---- Accessors ----

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'full_time'  => 'Full Time',
            'part_time'  => 'Part Time',
            'freelance'  => 'Freelance',
            'internship' => 'Magang',
            'contract'   => 'Kontrak',
            default      => $this->type,
        };
    }

    public function getLocationLabelAttribute()
    {
        return match ($this->location_type) {
            'onsite' => 'Onsite',
            'remote' => 'Remote',
            'hybrid' => 'Hybrid',
            default  => $this->location_type,
        };
    }

    public function getExperienceLabelAttribute()
    {
        return match ($this->experience) {
            'fresh_graduate' => 'Fresh Graduate',
            '1-2'            => '1-2 Tahun',
            '2-5'            => '2-5 Tahun',
            '5+'             => '5+ Tahun',
            default          => $this->experience,
        };
    }

    public function getSalaryRangeAttribute()
    {
        if (! $this->salary_visible) {
            return 'Negotiable';
        }

        return $this->salary_min && $this->salary_max
            ? 'Rp ' . number_format((float) $this->salary_min, 0, ',', '.') . ' – Rp ' . number_format((float) $this->salary_max, 0, ',', '.')
            : 'Negotiable';
    }

    // ---- Scopes ----

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeFilter($q, $r)
    {
        return $q->when($r->q, fn ($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->when($r->category, fn ($q) => $q->where('category_id', $r->category))
            ->when($r->type, fn ($q) => $q->where('type', $r->type))
            ->when($r->city, fn ($q) => $q->where('city', 'like', "%{$r->city}%"));
    }
}
