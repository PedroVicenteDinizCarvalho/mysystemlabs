<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingUser;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listTrainings = Training::listTrainings();
       
        return view('trainings', compact('listTrainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //VERIFICA SE EXISTE TREINO NO MESMO HORÁRIO
        $training = Training::compareTrainingSchedules($request->date_and_time, $request->end_training);
    
        if($training->count() == 0){
            $start = strtotime($request->date_and_time);
            $end = strtotime($request->end_training);
            $duration = date( 'H:i:s', abs( $end - $start ) );
        
            $request->validate([
                'name' => 'required|string|max:255',
                'maximum_students' => 'required|integer',
                'teacher_name' => 'required|string|max:255',
                'date_and_time' => 'required',
                'teacher_id' => 'required',
                'end_training' => 'required',
            ]);

            $user = Training::create([
                'name' => $request->name,
                'maximum_students' => $request->maximum_students,
                'teacher_name' => $request->teacher_name,
                'date_and_time' => $request->date_and_time,
                'duration' => $duration,
                'teacher_id' => $request->teacher_id,
                'end_training' => $request->end_training
            ]);
        
            return redirect()->back()->with(['sucess' => 'Treino registrado']);;
        }else{
            return redirect()->back()->withErrors(['name' => 'Essa data e horário já está ocupada por uma aula']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $student = auth()->user();
        $student->trainings()->attach($id);

        $training_changed = Training::find($id);
        $training_changed->total_students = $training_changed->total_students + 1;
        $training_changed->update();
        
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //VERIFICA SE EXISTE TREINO NO MESMO HORÁRIO
        $training = Training::compareTrainingSchedules($request->date_and_time, $request->end_training);

        if($training->count() == 0){
            $start = strtotime($request->date_and_time);
            $end = strtotime($request->end_training);
            $duration = date( 'H:i:s', abs( $end - $start ) );

            $request->validate([
                'name' => 'required|string|max:255',
                'maximum_students' => 'required|integer',
                'teacher_name' => 'required|string|max:255',
                'date_and_time' => 'required',
                'teacher_id' => 'required',
                'end_training' => 'required',
            ]);
    
            $data = $request->all();
            $training_changed = Training::find($id)->update($data);
    
            //VERIFICA SE EXISTEM ALUNOS MATRICULADOS
            $listTrainingUsers = TrainingUser::listTrainingUsers($id);
            if($listTrainingUsers->count() != 0){
                foreach ($listTrainingUsers as $key => $value) {
                    //Dispara email para os alunos avisando que a aula sofreu alterações
                    $details = [
                        'email_student' => $value->user()->email,
                        'name_student' => $value->user()->name,
                        'name_training' => $training_changed->name,
                        'maximum_students' => $training_changed->maximum_students,
                        'teacher_name' => $training_changed->teacher_name,
                        'date_and_time' => $training_changed->date_and_time,
                        'duration' => $duration,
                        'end_training' => $training_changed->end_training,
                    ];
                    \Mail::to($value->user()->email)->send(new \App\Mail\ChangeTraining($details));
                }
            }

            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['name' => 'Essa data e horário já está ocupada por uma aula']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Training::find($id)->delete();
        return redirect()->back();
    }

    //Realiza cancelamento do Check-in do usuário no treino
    public function cancel_checkin($id)
    {
        TrainingUser::cancelCheckin($id, Auth::user()->id);

        $training_changed = Training::find($id);
        $training_changed->total_students = $training_changed->total_students - 1;
        $training_changed->update();

        return redirect()->back();
    }
}
