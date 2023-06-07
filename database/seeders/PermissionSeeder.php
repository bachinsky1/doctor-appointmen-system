<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUsers = new Permission();
        $manageUsers->name = 'Manage users';
        $manageUsers->slug = 'manage-users';
        $manageUsers->save();

        $createAppointments = new Permission();
        $createAppointments->name = 'Create Appointments';
        $createAppointments->slug = 'create-appointments';
        $createAppointments->save();

        $manageAppointments = new Permission();
        $manageAppointments->name = 'Manage Appointments';
        $manageAppointments->slug = 'manage-appointments';
        $manageAppointments->save();
    }
}