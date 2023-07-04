<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultation_problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('consultation_id');
            $table->tinyInteger('hierarchy_level');
            $table->enum('classification_place', ['T', 'N'])->default('N');
            $table->enum('terminal_type', ['X', 'S'])->default('S');
            $table->integer('chapter_id');
            $table->string('code1', 3);
            $table->string('code2', 6);
            $table->string('code3', 6);
            $table->string('code4', 6);
            $table->string('title1', 255);
            $table->string('title2', 255);
            $table->string('title3', 255)->nullable();
            $table->string('reference1', 50)->nullable();
            $table->string('reference2', 50)->nullable();
            $table->string('reference3', 50)->nullable();
            $table->string('reference4', 50)->nullable();
            $table->string('reference5', 50)->nullable();
            $table->string('reference6', 50)->nullable();
            // $table->index(['chapter_id', 'title1']);
            $table->foreign('chapter_id')->references('id')->on('icd10_chapters')->onDelete('no action')->onUpdate('no action');
            $table->foreign('user_id')->references('id')->on('users'); // Creator
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_problems');
    }
};