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
        $sql = file_get_contents(__DIR__ . '/../../icd_10.sql');
        DB::unprepared($sql);
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('icd10_groups')->truncate();
        DB::table('icd10_codes')->truncate();
        DB::table('icd10_chapters')->truncate();
    }
};
