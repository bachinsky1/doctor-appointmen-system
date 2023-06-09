<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MedicalestablishmentType;

class MedicalestablishmentTypesSeeder extends Seeder
{
    public function run()
    {
        MedicalEstablishmentType::factory()->count(10)->create();
    }
}