<?php

/**
 * This code defines a RoleSeeder class that extends the Seeder class provided by Laravel. 
 * The purpose of this seeder is to create three roles in the database: Administrator, Health professional, and Patient. 
 * The run() method is called when the seeder is run, and it creates a new Role instance for each role, sets the name 
 * and slug attributes of each role, and saves the role to the database using the save() method.
 * Overall, this code is a simple and straightforward way to seed the database with some initial roles.
 */
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
        // Create a new Role instance for an administrator
        $admin = new Role();
        $admin->name = 'Administrator';
        $admin->slug = 'administrator';
        $admin->save();

        // Create a new Role instance for a health professional
        $healthProfessional = new Role();
        $healthProfessional->name = 'Health professional';
        $healthProfessional->slug = 'health-professional';
        $healthProfessional->save();

        // Create a new Role instance for a patient
        $patient = new Role();
        $patient->name = 'Patient';
        $patient->slug = 'patient';
        $patient->save();
    }
}