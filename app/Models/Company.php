<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'about', 'offer', 'location', 'image_path'];

    public function jobPositions()
    {
        return $this->hasMany(JobPosition::class);
    }

        public function images()
    {
        return $this->hasMany(Image::class);  // Assuming you have an Image model
    }
}
