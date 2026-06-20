<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyProfile extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'slug', 'logo', 'industry', 'city', 'description', 'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'user_id');
    }

    public function publicUsername(): string
    {
        return $this->slug ?: Str::slug($this->company_name) . '-' . $this->user_id;
    }
}
