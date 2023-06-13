<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Anesthesiologist', 
            'Cardiologist',
            'Dermatologist',
            'Endocrinologist',
            'Gastroenterologist',
            'Gynecologist',
            'Hematologist',
            'Hepatologist',
            'Infectiologist',
            'Internist',
            'Nephrologist',
            'Neurologist',
            'Oncologist',
            'Ophthalmologist',
            'Orthopedist',
            'Otorhinolaryngologist',
            'Pediatrician',
            'Psychiatrist',
            'Pulmonologist',
            'Rheumatologist',
            'Urologist',
        ];


        foreach ($positions as $position) {
            $pos = new Position();
            $pos->name = $position;
            $pos->save();
        }
    }
}
