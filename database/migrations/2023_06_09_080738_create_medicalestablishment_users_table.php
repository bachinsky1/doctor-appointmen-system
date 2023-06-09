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
        Schema::create('medicalestablishment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('medicalestablishment_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('medicalestablishment_id')->references('id')->on('medicalestablishments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
