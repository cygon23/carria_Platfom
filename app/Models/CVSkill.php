<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_basic_info_id', // Foreign key to cv_basic_infos
        'skill_name', // Name of the skill
    ];

    public function cvBasicInfo()
    {
        return $this->belongsTo(CVBasicInfo::class, 'cv_basic_info_id');
    }
}
