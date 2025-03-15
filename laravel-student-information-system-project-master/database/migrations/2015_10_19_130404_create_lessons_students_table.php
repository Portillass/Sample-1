<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year'); // 2015-2016
            $table->integer('semester'); // 1
            $table->integer('grade')->unsigned(); // 4
            $table->integer('department_id')->unsigned(); // Bilgisayar Müh.
            $table->integer('lesson_id')->unsigned(); // Otomata Teorileri
            $table->integer('student_id')->unsigned(); // Reyyan Arık
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lessons_students');
    }
}
