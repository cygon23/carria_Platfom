<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_basic_info_id',
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
    ];

    public function basicInfo()
    {
        return $this->belongsTo(CvBasicInfo::class, 'cv_basic_info_id');
    }
}
