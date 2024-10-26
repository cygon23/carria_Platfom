<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvBasicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo',
        'first_name',
        'last_name',
        'email',
        'phone',
        'description',
    ];

    public function educations()
    {
        return $this->hasMany(CvEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function skills()
    {
        return $this->hasMany(CVSkill::class);
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }
}
