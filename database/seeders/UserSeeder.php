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
        $medactRole = Role::where('slug', 'medical-actor')->first();
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

        $medact = new User();
        $medact->name = 'Lee Van Cliff';
        $medact->email = 'lee.van.cliff@mail.com';
        $medact->password = bcrypt('secret');
        $medact->save();
        $medact->roles()->attach($medactRole);
        $medact->permissions()->attach($createAppointments);
        $medact->permissions()->attach($manageAppointments);

        $patient = new User();
        $patient->name = 'Elly Wallah';
        $patient->email = 'elly.wallah@mail.com';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($patientRole);
        $patient->permissions()->attach($createAppointments);
        
    }
}