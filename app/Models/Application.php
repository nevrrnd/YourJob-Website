<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_id', 'seeker_id', 'cv_file', 'cover_letter', 'status', 'employer_note',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'   => 'Menunggu',
            'reviewed'  => 'Ditinjau',
            'interview' => 'Interview',
            'accepted'  => 'Diterima',
            'rejected'  => 'Ditolak',
            default     => $this->status,
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending'   => 'bg-yellow-100 text-yellow-800',
            'reviewed'  => 'bg-blue-100 text-blue-800',
            'interview' => 'bg-purple-100 text-purple-800',
            'accepted'  => 'bg-green-100 text-green-800',
            'rejected'  => 'bg-red-100 text-red-800',
            default     => 'bg-gray-100 text-gray-800',
        };
    }
}
