<?php

namespace Database\Factories;

use App\Models\MedicalEstablishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalEstablishmentFactory extends Factory
{
    protected $model = MedicalEstablishment::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(), // generates a random company name as the medical establishment name
            'email' => $this->faker->unique()->safeEmail(),
            'phone1' => $this->faker->phoneNumber(),
            'phone2' => $this->faker->optional()->phoneNumber(),
            'fax' => $this->faker->optional()->phoneNumber(),
            'type_id' => rand(1, 10), // generates a random type_id between 1 and 10
        ];
    }
}