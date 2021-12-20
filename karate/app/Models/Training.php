<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'maximum-students',
        'teacher-name',
        'date-and-time',
        'duration',
        'teacher_id'
    ];

    
}
