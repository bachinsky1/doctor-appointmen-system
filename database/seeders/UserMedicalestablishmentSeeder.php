<?php

namespace Database\Seeders;

use App\Models\Medicalestablishment;
use App\Models\Position;
use App\Models\User;
use App\Models\UserMedicalestablishment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMedicalestablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMedicalestablishment = new UserMedicalestablishment();
        $userMedicalestablishment->user_id = User::where('id', '2')->first()->id;
        $userMedicalestablishment->position_id = Position::where('id', '1')->first()->id;
        $userMedicalestablishment->medicalestablishment_id = Medicalestablishment::where('id', '1')->first()->id;
        $userMedicalestablishment->save();

        $userMedicalestablishment = new UserMedicalestablishment();
        $userMedicalestablishment->user_id = User::where('id', '2')->first()->id;
        $userMedicalestablishment->position_id = Position::where('id', '2')->first()->id;
        $userMedicalestablishment->medicalestablishment_id = Medicalestablishment::where('id', '2')->first()->id;
        $userMedicalestablishment->save();

        $userMedicalestablishment = new UserMedicalestablishment();
        $userMedicalestablishment->user_id = User::where('id', '2')->first()->id;
        $userMedicalestablishment->position_id = Position::where('id', '3')->first()->id;
        $userMedicalestablishment->medicalestablishment_id = Medicalestablishment::where('id', '3')->first()->id;
        $userMedicalestablishment->save();
    }
}
