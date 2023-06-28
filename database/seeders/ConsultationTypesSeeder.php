<?php

namespace Database\Seeders;

use App\Models\ConsultationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Medical consultation',
            'Non-medical consultation',
            'Medical external visit',
            'Non-medical external consultation',
            'Telemedecine consultation', 
        ];

        foreach ($types as $type) {
            ConsultationType::create([
                'name' => $type,
            ]);
        }
    }
}