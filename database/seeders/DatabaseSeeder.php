<?php

namespace Database\Seeders;

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
        $this->call([
            BouncerSeeder::class,
            UsersTableSeeder::class,
            MedicalestablishmentTypesSeeder::class,
            MedicalestablishmentsSeeder::class,
            AddressSeeder::class,
            AddressLinksSeeder::class,
            AppointmentTypesSeeder::class,
            AppointmentsSeeder::class,
            PositionSeeder::class,
            SpecialitySeeder::class,
            UserSpecialitySeeder::class,
            UserMedicalestablishmentSeeder::class,
            SymptomSeeder::class
        ]);
    }
}