<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;


    protected $fillable = [
        'award_name',
        'awarding_institution',
        'date_awarded',
        'description',
    ];

    public function basicInfo()
    {
        return $this->belongsTo(CVBasicInfo::class, 'cv_basic_info_id');
    }
}
