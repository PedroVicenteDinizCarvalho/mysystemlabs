<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('maximum_students');
            $table->integer('total_students')->default(0);
            $table->string('teacher_name');
            $table->datetime('date_and_time')->unique();
            $table->datetime('end_training');
            $table->time('duration');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
        });

        Schema::table('trainings', function(Blueprint $table){
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
