<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingUser;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
       
        return view('home', compact('listTrainings'));
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
        
        //Não encontrou treino no mesmo horário
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

            //ENVIA ALERTA DE SUCESSO
            Alert::success('Tudo certo', 'Seu treino está registrado');
            return redirect()->back();
        }
        else{ //Encontrou treino com mesmo horário e data
            //ENVIA ALERTA DE FALHA
            Alert::warning('Horário ocupado', 'Verificamos que já existe uma aula nesse horário. Tente cadastrar sua aula com horário ou data diferente.');
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
        //Retorna todos os Estudantes com check-in no treino
        $students = Training::with('users')->where('id', $id)->get();
       
        return view('training_students', compact('students'));
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

        //Verifica se existe usuário logado
        if($student){
            $studentTrainings = TrainingUser::listUserTraining($student->id, $id);

            //Caso usuário não tenha nenhum check-in feito ele pode finalizar sua ação
            if($studentTrainings->count() == 0){ 
                $training_changed = Training::find($id);

                //VERIFICA SE FALTAM MAIS DE 30 MINUTOS PARA COMEÇAR O TREINO
                $start = strtotime($training_changed->date_and_time);
                $end = strtotime(date('Y-m-d H:i:s'));
                $timer = date( 'H:i:s', abs( $end - $start ) );
              
                if($timer > strtotime("30 minutes")){
                    $student->trainings()->attach($id);

                    $training_changed->total_students = $training_changed->total_students + 1;
                    $training_changed->update();

                    //ENVIA ALERTA DE SUCESSO
                    Alert::success('Reserva feita', 'Estamos felizes sabendo que você está treinando!');
                    return redirect()->back();
                }
                else{ // FALTAM 30 MIN OU MENOS ENTÃO ALUNO NÃO PODE FAZER CHECK-IN

                    //ENVIA ALERTA DE FALHA
                    Alert::warning('Tente mais cedo na próxima', 'Este treino já está quase começando e não aceita mais reservas');
                    return redirect()->back();
                }
            }
            else{ //Se constar algum check-in em alguma aula verificamos se já fez check in neste treino
                foreach($studentTrainings as $studentTraining){

                    //Se realizou check-in retornamos ele de volta para view
                    if($studentTraining->training_id == $id){

                        //ENVIA ALERTA DE FALHA
                        Alert::warning('Você já fez reserva nessa aula', 'Caso a reserva seja para outra pessoa, peça para que ela crie uma conta na Karate System');
                        return redirect()->back();
                    }
                    else{ //Se ele não estiver com check-in neste treino deixamos ele finalizar a ação
                        $training_changed = Training::find($id);

                        //VERIFICA SE FALTAM MAIS DE 30 MINUTOS PARA COMEÇAR O TREINO
                        $start = strtotime($training_changed->date_and_time);
                        $end = strtotime(date('Y-m-d H:i:s'));
                        $timer = date( 'H:i:s', abs( $end - $start ) );
                        if($timer > strtotime("30 minutes")){ 
                            $student->trainings()->attach($id);

                            $training_changed->total_students = $training_changed->total_students + 1;
                            $training_changed->update();

                            //ENVIA ALERTA DE SUCESSO
                            Alert::success('Reserva feita', 'Estamos felizes sabendo que você está treinando!');
                            return redirect()->back();
                        }
                        else{ // FALTAM 30 MIN OU MENOS ENTÃO ALUNO NÃO PODE FAZER CHECK-IN

                            //ENVIA ALERTA DE FALHA
                            Alert::warning('Tente mais cedo na próxima', 'Este treino já está quase começando e não aceita mais reservas');
                            return redirect()->back();
                        }
                    }
                }
            }
        }
        else{
            return redirect()->back();
        }
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
        //VERIFICA SE EXISTE TREINO NO MESMO HORÁRIO QUE SEJA DIFERENTE DO QUE QUEREMOS EDITAR
        $training = Training::compareTrainingSchedules($request->date_and_time, $request->end_training);
        
        //Não encontrou treino no mesmo horário
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
    
            //VERIFICA SE EXISTEM ALUNOS MATRICULADOS PARA ENVIAR DISPARO DE EMAIL
            //Retorna todos os Estudantes com check-in no treino
            $students = Training::with('users')->where('id', $id)->get();
            if($students->count() != 0){
                foreach ($students as $item) {
                    foreach ($item as $value) {
                        //Dispara email para os alunos avisando que a aula sofreu alterações
                        $details = [
                            'email_student' => $value->email,
                            'name_student' => $value->name,
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
            }

            //ENVIA ALERTA DE SUCESSO
            Alert::success('Treino atualizado', 'Seu treino foi atualizado e já avisamos os alunos por email');
            return redirect()->back();
        }
        else{
            //Caso os ids forem iguais podemos editar o treino normalmente 
            if($training[0]->id == $id){ 
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
                $training_changed = Training::find($id)->update($data); //Atualiza
                
                //ATUALIZOU DADOS COM SUCESSO
                if($training_changed){
                    //VERIFICA SE EXISTEM ALUNOS MATRICULADOS PARA ENVIAR DISPARO DE EMAIL
                    $students = Training::with('users')->where('id', $id)->get();
                    if($students->count() != 0){
                        foreach ($students as $item) {
                            foreach ($item->users as $value) {
                                //Dispara email para os alunos avisando que a aula sofreu alterações
                                $details = [
                                    'email_student' => $value->email,
                                    'name_student' => $value->name,
                                    'name_training' => $data['name'],
                                    'maximum_students' => $data['maximum_students'],
                                    'teacher_name' => $data['teacher_name'],
                                    'date_and_time' => $data['date_and_time'],
                                    'duration' => $duration,
                                    'end_training' => $data['end_training'],
                                ];
                                \Mail::to($value->email)->send(new \App\Mail\ChangeTraining($details));
                            }
                        }
                    }

                    //ENVIA ALERTA DE SUCESSO
                    Alert::success('Treino atualizado', 'Seu treino foi atualizado e já avisamos os alunos por email');
                    return redirect()->back();
                }
                else{
                    //ENVIA ALERTA DE FALHA
                    Alert::warning('Ops, ocorreu algum problema', 'Ainda não entendemos o que aconteceu, se persistir entre em contato com nosso suporte.');
                    return redirect()->back()->withErrors(['name' => 'Ainda não entendemos o que aconteceu, se persistir entre em contato com nosso suporte.']);
                }  
            }
            else{
                //ENVIA ALERTA DE FALHA
                Alert::warning('Horário ocupado', 'Verificamos que já existe uma aula nesse horário. Tente cadastrar sua aula com horário ou data diferente.');
                return redirect()->back()->withErrors(['name' => 'Essa data e horário já está ocupada por uma aula']);
            }
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

        //ENVIA ALERTA DE SUCESSO
        Alert::success('Treino removido', 'O treino foi cancelado com sucesso');
        return redirect()->back();
    }

    //Realiza cancelamento do Check-in do usuário no treino
    public function cancel_checkin($id)
    {
        $student = auth()->user();
        $student->trainings()->detach($id);

        $training_changed = Training::find($id);
        $training_changed->total_students = $training_changed->total_students - 1;
        $training_changed->update();

        //ENVIA ALERTA DE SUCESSO
        Alert::success('Reserva desfeita', 'Ficamos tristes com sua desistência. Queremos te ver treinando, tente reservar outra aula.');
        return redirect()->back();
    }
}
