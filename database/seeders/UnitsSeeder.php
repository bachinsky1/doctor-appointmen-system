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
            ['name' => 'Heartbeat', 'unit' => 'bpm', 'icon' => 'fas fa-heartbeat'],
            ['name' => 'Temperature', 'unit' => '°C', 'icon' => 'fas fa-thermometer-half'],
            ['name' => 'Pressure', 'unit' => 'mmHg', 'icon' => 'fas fa-tachometer-alt'],
            ['name' => 'Breathing rate', 'unit' => 'breaths/min', 'icon' => 'fas fa-lungs'],
            ['name' => 'Peak flow', 'unit' => 'L/min', 'icon' => 'fas fa-wind'],
            ['name' => 'Saturation', 'unit' => '%', 'icon' => 'fas fa-lungs-oxygen'],
            ['name' => 'PT', 'unit' => 'sec', 'icon' => 'fas fa-stopwatch'],
            ['name' => 'Glucose', 'unit' => 'mg/dL', 'icon' => 'fas fa-flask'],
            ['name' => 'HbA1c', 'unit' => '%', 'icon' => 'fas fa-notes-medical'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
