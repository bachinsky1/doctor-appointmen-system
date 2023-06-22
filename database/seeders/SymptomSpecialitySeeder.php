<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSpecialitySeeder extends Seeder
{
    /**
     * 
     * This method retrieves all the specialities and symptoms from their respective tables using the DB facade. 
     * It then loops through each speciality and generates a random number of symptoms between 10 and 20. 
     * It selects these random symptoms from the list of all symptoms and inserts them into the symptom_specialities 
     * table along with the corresponding speciality ID. 
     * Overall, this code generates random relationships between specialities and symptoms in the database.
     */
    public function run(): void
    {
        $specialities = DB::table('specialities')->get();
        $symptoms = DB::table('symptoms')->get();

        foreach ($specialities as $speciality) {
            $symptomsCount = rand(5, 10);
            $selectedSymptoms = $symptoms->random($symptomsCount);

            foreach ($selectedSymptoms as $symptom) {
                DB::table('symptom_specialities')->insert([
                    'speciality_id' => $speciality->id,
                    'symptom_id' => $symptom->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
