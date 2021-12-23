<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ROTAS ADMINISTRATIVAS
Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/', function () {
        
        return view('dashboard');
    });

    //Professores CRUD
    Route::get('/professores', [TeacherController::class, 'index'])
                ->name('professores');
    Route::post('/professores/salvar', [TeacherController::class, 'store'])
                ->name('criar_professor');
    Route::post('/professores/editar/{id}', [TeacherController::class, 'update'])
                ->name('editar_professor');
    Route::get('/professores/excluir/{id}', [TeacherController::class, 'destroy'])
                ->name('excluir_professor');

    //Alunos CRUD
    Route::get('/alunos', [StudentController::class, 'index'])
                ->name('alunos');
    Route::post('/alunos/salvar', [StudentController::class, 'store'])
                ->name('criar_aluno');
    Route::post('/alunos/editar/{id}', [StudentController::class, 'update'])
                ->name('editar_aluno');
    Route::get('/alunos/excluir/{id}', [StudentController::class, 'destroy'])
                ->name('excluir_aluno');

    
    //Treinos CRUD
    Route::get('/treinos', [TrainingController::class, 'index'])
                ->name('alunos');
    Route::post('/treinos/salvar', [TrainingController::class, 'store'])
                ->name('criar_treino');
    Route::post('/treinos/editar/{id}', [TrainingController::class, 'update'])
                ->name('editar_treino');
    Route::get('/treinos/excluir/{id}', [TrainingController::class, 'destroy'])
                ->name('excluir_treino');

    //Aluno faz check-in no treino
    Route::get('/treinos/reservar/{id}', [TrainingController::class, 'edit'])
                ->name('reservar_treino');
    //Aluno cancela check-in no treino
    Route::get('/treinos/reservar/cancelar/{id}', [TrainingController::class, 'cancel_checkin'])
                ->name('cancelar_treino');
   
});
