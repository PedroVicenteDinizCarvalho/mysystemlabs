<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

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
            $request->validate([
                'name' => 'required|string|max:255',
                'maximum_students' => 'required|integer',
                'teacher_name' => 'required|string|max:255',
                'date_and_time' => 'required',
                'duration' => 'required',
                'teacher_id' => 'required',
                'end_training' => 'required',
            ]);

            $user = Training::create([
                'name' => $request->name,
                'maximum_students' => $request->maximum_students,
                'teacher_name' => $request->teacher_name,
                'date_and_time' => $request->date_and_time,
                'duration' => $request->duration,
                'teacher_id' => $request->teacher_id,
                'end_training' => $request->end_training
            ]);
        
            return redirect()->back();
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
        //
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
            $request->validate([
                'name' => 'required|string|max:255',
                'maximum_students' => 'required|integer',
                'teacher_name' => 'required|string|max:255',
                'date_and_time' => 'required',
                'duration' => 'required',
                'teacher_id' => 'required',
                'end_training' => 'required',
            ]);
    
            $data = $request->all();
            Training::find($id)->update($data);
    
            //VERIFICA SE EXISTEM ALUNOS MATRICULADOS
            $listTrainingUsers = TrainingUser::listTrainingUsers($id);
            if($listTrainingUsers->count() != 0){
                foreach ($listTrainingUsers as $key => $value) {
                    //Dispara email para os alunos avisando que a aula sofreu alterações
                    
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
}
