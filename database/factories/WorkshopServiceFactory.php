<?php

namespace Database\Factories;

use App\Models\ServiceType;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkshopService>
 */
class WorkshopServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workshop_id' => Workshop::factory(),
            'service_type_id' => ServiceType::factory(),
            'duration_minutes' => fake()->numberBetween(20,90),
            'price' => fake()->randomFloat(2, 1500, 8000),
        ];
    }
}
