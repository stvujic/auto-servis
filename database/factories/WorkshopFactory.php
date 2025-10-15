<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workshop>
 */
class WorkshopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(['role'=>'owner']),
            'name' => fake()->company(),
            'city'=> fake()->city(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->e164PhoneNumber(),
            'description' => fake()->sentence(10),
            'is_verified' => fake()->boolean(70),
            'avg_rating'=> 0,
        ];
    }
}
