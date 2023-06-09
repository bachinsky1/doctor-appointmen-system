<?php

namespace Database\Factories;

use App\Models\MedicalEstablishmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalEstablishmentTypeFactory extends Factory
{
    protected $model = MedicalEstablishmentType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(), // generates a random word as the name
        ];
    }
}