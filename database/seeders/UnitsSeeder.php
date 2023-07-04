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
            ['name' => 'units.heartbeat', 'unit' => 'bpm', 'icon' => 'fas fa-heartbeat', 'is_vitalsign' => true],
            ['name' => 'units.temperature', 'unit' => '°C', 'icon' => 'fas fa-thermometer-half', 'is_vitalsign' => true],
            ['name' => 'units.pressure', 'unit' => 'mmHg', 'icon' => 'fas fa-tachometer-alt', 'is_vitalsign' => true],
            ['name' => 'units.breathing_rate', 'unit' => 'breaths/min', 'icon' => 'fas fa-lungs', 'is_vitalsign' => true],
            ['name' => 'units.peak_flow', 'unit' => 'L/min', 'icon' => 'fas fa-wind', 'is_vitalsign' => true],
            ['name' => 'units.saturation', 'unit' => '%', 'icon' => 'fas fa-lungs', 'is_vitalsign' => true],
            ['name' => 'units.pt', 'unit' => 'sec', 'icon' => 'fas fa-stopwatch', 'is_vitalsign' => true],
            ['name' => 'units.glucose', 'unit' => 'mg/dL', 'icon' => 'fas fa-flask', 'is_vitalsign' => true],
            ['name' => 'units.hba1c', 'unit' => '%', 'icon' => 'fas fa-notes-medical', 'is_vitalsign' => true],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
