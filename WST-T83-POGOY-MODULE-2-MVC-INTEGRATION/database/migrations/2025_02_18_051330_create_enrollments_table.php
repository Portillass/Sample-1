<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // Changed from user_id to email
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('contact_number');
            $table->string('course');
            $table->integer('year_level');
            $table->string('semester');
            $table->string('academic_year');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->string('emergency_contact');
            $table->string('emergency_number');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
