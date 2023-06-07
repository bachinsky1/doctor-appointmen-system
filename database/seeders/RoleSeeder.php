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

        $medact = new Role();
        $medact->name = 'Medical actor';
        $medact->slug = 'medical-actor';
        $medact->save();

        $patient = new Role();
        $patient->name = 'Patient';
        $patient->slug = 'patient';
        $patient->save();
    }
}