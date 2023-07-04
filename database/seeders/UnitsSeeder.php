<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Heartbeat', 'unit' => 'bpm', 'icon' => 'fas fa-heartbeat', 'is_vitalsign' => true],
            ['name' => 'Temperature', 'unit' => '°C', 'icon' => 'fas fa-thermometer-half', 'is_vitalsign' => true],
            ['name' => 'Pressure', 'unit' => 'mmHg', 'icon' => 'fas fa-tachometer-alt', 'is_vitalsign' => true],
            ['name' => 'Breathing rate', 'unit' => 'breaths/min', 'icon' => 'fas fa-lungs', 'is_vitalsign' => true],
            ['name' => 'Peak flow', 'unit' => 'L/min', 'icon' => 'fas fa-wind', 'is_vitalsign' => true],
            ['name' => 'Saturation', 'unit' => '%', 'icon' => 'fas fa-lungs', 'is_vitalsign' => true],
            ['name' => 'PT', 'unit' => 'sec', 'icon' => 'fas fa-stopwatch', 'is_vitalsign' => true],
            ['name' => 'Glucose', 'unit' => 'mg/dL', 'icon' => 'fas fa-flask', 'is_vitalsign' => true],
            ['name' => 'HbA1c', 'unit' => '%', 'icon' => 'fas fa-notes-medical', 'is_vitalsign' => true],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
