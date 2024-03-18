<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('studentlists', function (Blueprint $table) {
            $table->id();
            $table->string('lrn');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->integer('age');
            $table->string('sex');
            $table->string('address');
            $table->string('contactnumber');
            $table->string('grade');
            $table->string('strand_course');
            $table->string('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentlists');
    }
};
