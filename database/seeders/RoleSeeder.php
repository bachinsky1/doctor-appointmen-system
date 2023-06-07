<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Administrator';
        $admin->slug = 'administrator';
        $admin->save();

        $healthProfessional = new Role();
        $healthProfessional->name = 'Health professional';
        $healthProfessional->slug = 'health-professional';
        $healthProfessional->save();

        $patient = new Role();
        $patient->name = 'Patient';
        $patient->slug = 'patient';
        $patient->save();
    }
}