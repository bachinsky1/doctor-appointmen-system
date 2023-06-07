<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'administrator')->first();
        $healthProfessionalRole = Role::where('slug', 'health-professional')->first();
        $patientRole = Role::where('slug','patient')->first();
        
        $manageUsers = Permission::where('slug','manage-users')->first();
        $createAppointments = Permission::where('slug','create-appointments')->first();
        $manageAppointments = Permission::where('slug','manage-appointments')->first();

        $admin = new User();
        $admin->name = 'Clint Eastwood';
        $admin->email = 'clint.eastwood@mail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($manageUsers);

        $healthProfessional = new User();
        $healthProfessional->name = 'Lee Van Cliff';
        $healthProfessional->email = 'lee.van.cliff@mail.com';
        $healthProfessional->password = bcrypt('secret');
        $healthProfessional->save();
        $healthProfessional->roles()->attach($healthProfessionalRole);
        $healthProfessional->permissions()->attach($createAppointments);
        $healthProfessional->permissions()->attach($manageAppointments);

        $patient = new User();
        $patient->name = 'Elly Wallah';
        $patient->email = 'elly.wallah@mail.com';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($patientRole);
        $patient->permissions()->attach($createAppointments);
        
    }
}