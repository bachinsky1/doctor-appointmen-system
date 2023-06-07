<?php
/**
 * This code defines a DatabaseSeeder class that extends the Seeder class provided by Laravel. 
 * The purpose of this seeder is to seed the application's database with some initial data. 
 * The run() method is called when the seeder is run, 
 * and it calls three other seeders: RoleSeeder, PermissionSeeder, and UserSeeder. 
 * These seeders are responsible for seeding roles, permissions, and users into the database, respectively.
 * Overall, this code is a simple and effective way to seed an application's database with some initial data.
 */
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
