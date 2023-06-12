<?php

namespace Database\Seeders;

use App\Models\AppointmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Consultation', 
            'Non-medical consultation', 
            'Telemedecine consultation',
            'External visit', 
            'Professional', 
            'Private', 
        ];

        foreach ($types as $type) {
            AppointmentType::create([
                'name' => $type,
            ]);
        }
    }
}
