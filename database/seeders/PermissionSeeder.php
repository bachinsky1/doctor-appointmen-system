<?php

/**
 * This is a PHP code that defines a `PermissionSeeder` class in the Laravel framework. Here's a breakdown of what this code does:
 * - The first line declares the namespace for the `PermissionSeeder` class.
 * - The next two lines import the `Permission` and `Seeder` classes from Laravel's Eloquent ORM (Object-Relational Mapping) system.
 * - The `PermissionSeeder` class extends the `Seeder` class, which provides it with a `run()` method that will be called when this seeder is run.
 * - The `run()` method creates three new `Permission` objects, sets their `name` and `slug` properties, and saves them to the database using the `save()` method.
 * Overall, this code sets up a seeder that can be used to populate the `permissions` table in the database with some initial data. 
 * In this case, it creates three permissions: "Manage users", "Create Appointments", and "Manage Appointments".
 */
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