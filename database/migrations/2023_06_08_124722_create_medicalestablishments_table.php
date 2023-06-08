<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalestablishmentsTable extends Migration
{
    public function up()
    {
        Schema::create('medicalestablishments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('medicalestablishments')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('medicalestablishment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('medicalestablishment_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('medicalestablishment_id')->references('id')->on('medicalestablishments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['medicalestablishment_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicalestablishment_user');
        Schema::dropIfExists('medicalestablishments');
    }
}