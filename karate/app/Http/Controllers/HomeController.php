<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_type == 'teacher'){
            $teacher_id = Auth::user()->id;
            $teachertraining = Training::teacherTraining($teacher_id);
            return view('home', compact('teachertraining'));
        }else{
            $student = auth()->user();
            $studentTraining = $student->trainings;
            
            $trainingToday = Training::listPresentTraining();
            $trainingWeek = Training::listMonthTraining();


            return view('home', compact('studentTraining', 'trainingToday', 'trainingWeek'));
        }
    }
}
