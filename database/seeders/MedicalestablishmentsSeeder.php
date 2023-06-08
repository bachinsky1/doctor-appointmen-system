<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Medicalestablishment;
use App\Models\User;

class MedicalestablishmentsSeeder extends Seeder
{
    public function run()
    {
        $establishments = [
            ['name' => 'St. Mary Hospital', 'address' => '17st', 'type_id' => '1'],
            ['name' => 'City Clinic', 'address' => '17st', 'type_id' => '2'],
            ['name' => 'Healthy Pharmacy', 'address' => 'Hollywood avenue', 'type_id' => '3']
        ];

        foreach ($establishments as $establishment) {
            $medicalestablishment = Medicalestablishment::create($establishment);

            
            $users = User::inRandomOrder()->limit(3)->get();
            foreach ($users as $user) {
                $medicalestablishment->users()->attach($user);
            }
        }
    }
}