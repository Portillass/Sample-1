<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('email')->unique()->after('id');
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['email']);
            $table->dropColumn('email');
        });
    }
};