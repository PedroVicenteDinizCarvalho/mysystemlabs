<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainingUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'training_id'];

    public static function listAllTrainingUsers($training_id){
        $listUsersAdmin = DB::table('training_user')
                ->select( 
                'user_id',
                'training_id')
                ->where('training_id', '=', $training_id)
                ->get();
        return $listUsersAdmin;
    }

    public static function listTrainingUsers($training_id){
        $listUsersAdmin = DB::table('training_user')
                ->select( 
                'user_id',
                'training_id')
                ->where('training_id', '=', $training_id)
                ->get();
        return $listUsersAdmin;
    }

    public static function listUserTrainings($user_id){
        $listUsersAdmin = DB::table('training_user')
                ->select( 
                'user_id',
                'training_id')
                ->where('user_id', '=', $user_id)
                ->get();
        return $listUsersAdmin;
    }

    public static function cancelCheckin($id, $user_id){
        $listUsersAdmin = DB::table('training_user')
                ->select( 
                'user_id',
                'training_id')
                ->where('user_id', '=', $user_id)
                ->where('training_id', '=', $id)
                ->delete();
        return $listUsersAdmin;
    }
}
