<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'gender',
        'graduate',
        'picture',
        'type_of_fight',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function training()
    {
        return $this->hasOne(Training::class, 'teacher_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_users', 'user_id', 'training_id');
    }

    public static function listUserStudents(){
        $listUsersAdmin = DB::table('users')
                ->select( 
                'name',
                'email',
                'password',
                'age',
                'gender',
                'graduate',
                'picture',
                'type_of_fight',
                'user_type')
                ->where('user_type', '=', 'student')
                ->get();
        return $listUsersAdmin;
    }

    public static function listUserTeachers(){
        $listUsersAdmin = DB::table('users')
                ->select( 
                'name',
                'email',
                'password',
                'age',
                'gender',
                'graduate',
                'picture',
                'type_of_fight',
                'user_type')
                ->where('user_type', '=', 'teacher')
                ->get();
        return $listUsersAdmin;
    }
}
