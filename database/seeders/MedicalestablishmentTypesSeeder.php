<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MedicalestablishmentType;

class MedicalestablishmentTypesSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['name' => 'Hospital'],
            ['name' => 'Clinic'],
            ['name' => 'Pharmacy']
        ];

        foreach ($types as $type) {
            MedicalestablishmentType::create($type);
        }
    }
}