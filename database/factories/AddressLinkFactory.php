<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddressLink>
 */
class AddressLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address_id' => rand(1, 10), 
            'user_id' => rand(1, 10), 
            'medicalestablishment_id' => rand(1, 10), 
            'is_main' => $this->faker->boolean(), 
        ];
    }
}
