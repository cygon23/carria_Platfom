<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs_';

    protected $fillable = [
        'title',
        'category_id',
        'job_type_id',
        'user_id',
        'vacancy',
        'salary',
        'location',
        'description',
        'benefits',
        'responsibility',
        'qualifications',
        'keywords',
        'experience',
        'company_name',
        'company_location',
        'website',

    ];

    public function JobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }


    public function user()
    {
        return $this->hasMany(User::class);
    }
}
