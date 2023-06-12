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
        Schema::create('user_medicalestablishments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('medicalestablishment_id');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->foreign('medicalestablishment_id')->references('id')->on('medicalestablishments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('user_positions');
            $table->foreign('speciality_id')->references('id')->on('user_specialities');
            $table->primary(['user_id', 'medicalestablishment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_medicalestablishments');
    }
};
