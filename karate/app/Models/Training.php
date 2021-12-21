<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Training extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'maximum_students',
        'teacher_name',
        'date_and_time',
        'duration',
        'teacher_id',
        'end_training'
    ];

    public static function listTrainings(){
        $listUsersAdmin = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->get();
        return $listUsersAdmin;
    }

    public static function listFutureTrainings(){
        $listUsersAdmin = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '>', date('Y-m-d H:i:s'))
                ->get();
        return $listUsersAdmin;
    }

    public static function listOldTrainings(){
        $listUsersAdmin = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '<', date('Y-m-d H:i:s'))
                ->get();
        return $listUsersAdmin;
    }

    public static function listPresentTraining(){
        $listUsersAdmin = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '=', date('Y-m-d H:i:s'))
                ->get();
        return $listUsersAdmin;
    }

    public static function compareTrainingSchedules($date_and_time, $end_training){
        $listUsersAdmin = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->whereBetween('date_and_time', [$date_and_time, $end_training])
                ->whereBetween('end_training', [$date_and_time, $end_training])
                ->get();
        return $listUsersAdmin;
    }

}
