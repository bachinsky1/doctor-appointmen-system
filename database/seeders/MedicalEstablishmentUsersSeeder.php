<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MedicalEstablishment;

class MedicalestablishmentUserssSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $medicalEstablishments = MedicalEstablishment::all();

        foreach ($users as $user) {
            $user->medicalEstablishments()->attach(
                $medicalEstablishments->random(rand(1, 10))->pluck('id')->toArray()
            );
        }
    }
}