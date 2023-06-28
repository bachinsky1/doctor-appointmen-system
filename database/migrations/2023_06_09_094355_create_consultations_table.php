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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('appointment_id')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->boolean('is_opened')->default(true);
            $table->foreign('user_id')->references('id')->on('users'); // Consultation creator
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('consultation_types');
            $table->foreign('appointment_id')->references('id')->on('appointments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
