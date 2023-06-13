<?php

namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\User;
use App\Models\UserSpeciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userSpeciality = new UserSpeciality();
        $userSpeciality->user_id = User::where('id', '2')->first()->id;
        $userSpeciality->speciality_id = Speciality::where('id', '1')->first()->id; 
        $userSpeciality->save();

        $userSpeciality = new UserSpeciality();
        $userSpeciality->user_id = User::where('id', '2')->first()->id;
        $userSpeciality->speciality_id = Speciality::where('id', '2')->first()->id;
        $userSpeciality->save();

        $userSpeciality = new UserSpeciality();
        $userSpeciality->user_id = User::where('id', '2')->first()->id;
        $userSpeciality->speciality_id = Speciality::where('id', '3')->first()->id;
        $userSpeciality->save();
    }
}
