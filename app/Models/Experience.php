<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'basic_id',
        'job_title',
        'company_name',
        'location',
        'start_date',
        'end_date',
        'description',
    ];

    // Relationship with the Basic model
    public function basic()
    {
        return $this->belongsTo(CvBasicInfo::class);
    }
}
