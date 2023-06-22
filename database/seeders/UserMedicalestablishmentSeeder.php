<?php

namespace Database\Seeders;

use App\Models\Medicalestablishment;
use App\Models\Position;
use App\Models\User;
use App\Models\UserMedicalestablishment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMedicalestablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with role_id = 3
        $users = DB::table('assigned_roles')
            ->where('role_id', 3)
            ->pluck('entity_id');

        // Receive all medical facilities and positions
        $medicalestablishments = Medicalestablishment::all();
        $positions = Position::all();

        // For each user, we create from 1-2 records in the user_medicalestablishments table
        foreach ($users as $user_id) {
            $count = rand(1, 2);
            $establishments = $medicalestablishments->random($count);

            foreach ($establishments as $establishment) {
                $position = $positions->random();
                DB::table('user_medicalestablishments')->insert([
                    'user_id' => $user_id,
                    'medicalestablishment_id' => $establishment->id,
                    'position_id' => $position->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
