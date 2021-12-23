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
        'total_students',
        'teacher_name',
        'date_and_time',
        'duration',
        'teacher_id',
        'end_training'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public static function listTrainings(){
        $listTrainings = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'total_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->get();
        return $listTrainings;
    }

    public static function listFutureTrainings(){
        $listTrainings = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'total_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '>', date('Y-m-d H:i:s'))
                ->get();
        return $listTrainings;
    }

    public static function listOldTrainings(){
        $listTrainings = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'total_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '<', date('Y-m-d H:i:s'))
                ->get();
        return $listTrainings;
    }

    public static function listPresentTraining(){
        $listTrainings = DB::table('trainings')
                ->select( 
                'id',
                'name',
                'maximum_students',
                'total_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->where('date_and_time', '>=', date('Y-m-d'))
                ->orderBy('date_and_time')
                ->limit(6)
                ->get();
        return $listTrainings;
    }

    public static function compareTrainingSchedules($date_and_time, $end_training){
        $listTrainings = DB::table('trainings')
                ->select( 
                'name',
                'maximum_students',
                'total_students',
                'teacher_name',
                'date_and_time',
                'duration',
                'teacher_id',
                'end_training')
                ->whereBetween('date_and_time', [$date_and_time, $end_training])
                ->orWhereBetween('end_training', [$date_and_time, $end_training])
                ->get();
        return $listTrainings;
    }

    public static function teacherTraining($id){
        $listTrainings = DB::table('trainings')
        ->select( 
            'id',
            'name',
            'maximum_students',
            'total_students',
            'teacher_name',
            'date_and_time',
            'duration',
            'teacher_id',
            'end_training')
        ->where('teacher_id', '=', $id)
        ->orderBy('date_and_time')
        ->get();
        return $listTrainings;
    }
}
