<?php

namespace Database\Seeders;

use App\Models\Medicalestablishment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMedicalestablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $medicalEstablishments = Medicalestablishment::all();

        foreach ($users as $user) {
            $user->medicalEstablishments()->attach(
                $medicalEstablishments->random(rand(1, 10))->pluck('id')->toArray()
            );
        }
    }
}
