<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalestablishment_users', function (Blueprint $table) {
            $table->unsignedBigInteger('medicalestablishment_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('speciality_id');
            $table->foreign('medicalestablishment_id')->references('id')->on('medicalestablishments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('user_positions');
            $table->foreign('speciality_id')->references('id')->on('user_specialities');
            $table->primary(['medicalestablishment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicalestablishment_user');
    }
};
