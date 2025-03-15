<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_student_id')->unsigned(); // LessonStudent
            $table->string('year'); // 2015-2016
            $table->integer('semester'); // 1
            $table->integer('grade')->unsigned(); // 4
            $table->integer('department_id')->unsigned(); // Bilgisayar Müh.
            $table->integer('lesson_id')->unsigned(); // Otomata Teorileri
            $table->integer('student_id')->unsigned(); // Reyyan Arık
            $table->integer('midterm_score')->nullable();
            $table->integer('final_score')->nullable();
            $table->integer('avarage_score')->nullable();
            $table->string('avarage_score_letter')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('lesson_student_id')->references('id')->on('lessons_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scores');
    }
}
