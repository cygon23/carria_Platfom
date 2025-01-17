<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVuploaded extends Model
{
     use HasFactory;

     protected $table = 'users';
     protected $fillable = ['file_path', 'user_name', 'submission_date'];
}
