<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Medicalestablishment;
use App\Models\User;

class MedicalestablishmentsSeeder extends Seeder
{
    public function run()
    {
        MedicalEstablishment::factory()->count(10)->create();
    }
}