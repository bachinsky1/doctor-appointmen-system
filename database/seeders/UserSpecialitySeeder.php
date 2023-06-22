<?php

namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\User;
use App\Models\UserSpeciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with role_id = 3 from assigned_roles table
        $users = DB::table('assigned_roles')
            ->where('role_id', 3)
            ->pluck('entity_id');

        // For each user, we get a random specialty and add it to the user_specialities table
        foreach ($users as $user_id) {
            $speciality_id = DB::table('specialities')->inRandomOrder()->value('id');
            DB::table('user_specialities')->insert([
                'user_id' => $user_id,
                'speciality_id' => $speciality_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
