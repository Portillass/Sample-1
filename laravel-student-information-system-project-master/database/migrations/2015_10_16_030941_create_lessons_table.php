<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade')->unsigned()->index(); // 4
            $table->integer('semester')->unsigned(); // 1
            $table->string('code')->unique(); // BIL 445
            $table->string('name'); // Otomata
            $table->integer('credit')->unsigned(); // 6
            $table->integer('lecturer_id')->unsigned(); // Umut Orhan
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('lecturers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lessons');
    }
}
