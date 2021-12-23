<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Cria usuários professores
        $this->createTeachers();

        //Cria usuários alunos
        $this->createStudents();
    }

    private function createTeachers()
    {
        ModelsUser::create([
            'email' => 'jackie@karate.com', 
            'name'  => 'Jackie Chan',
            'age' => 40,
            'gender' => 'male',
            'graduate' => 'Preta',
            'user_type' => 'teacher',
            'password' => bcrypt('clubedalutaZW')
        ]);

        ModelsUser::create([
            'email' => 'lyoto@karate.com', 
            'name'  => 'Lyoto Machida',
            'age' => 38,
            'gender' => 'male',
            'graduate' => 'Preta',
            'user_type' => 'teacher',
            'password' => bcrypt('clubedalutaZW')
        ]);
    }

    private function createStudents()
    {
        ModelsUser::create([
            'email' => 'jose@karate.com', 
            'name'  => 'Jose Chan',
            'age' => 20,
            'gender' => 'male',
            'graduate' => 'Branca',
            'user_type' => 'student',
            'password' => bcrypt('clubedalutaZW')
        ]);
    }
}
