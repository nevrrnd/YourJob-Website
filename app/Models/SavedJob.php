<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    public $timestamps = false;

    protected $table = 'saved_jobs';

    protected $fillable = ['user_id', 'job_id', 'created_at'];
}
