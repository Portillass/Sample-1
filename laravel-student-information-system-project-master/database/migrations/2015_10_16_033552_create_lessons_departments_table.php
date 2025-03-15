<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year'); // 2015-2016
            $table->integer('semester'); // 1
            $table->integer('grade')->unsigned(); // 4
            $table->integer('lesson_id')->unsigned(); // Otomata
            $table->integer('department_id')->unsigned(); // Bilgisayar Müh.
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lessons_departments');
    }
}
