<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkshopService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Ako baza nema nijedan WorkshopService, napravimo ga sa ovim
        $ws = WorkshopService::inRandomOrder()->first()
            ?? WorkshopService::factory()->create();

        return [
            'user_id' => User::factory(['role' => 'customer']),
            'workshop_id' => $ws->workshop_id,
            'workshop_service_id' => $ws->id,
            'scheduled_at'        => now()->addDays(fake()->numberBetween(1, 14))->setTime(10, 0),
            'duration_minutes'    => $ws->duration_minutes,
            'status'              => 'pending',
            'notes'               => fake()->optional()->sentence(),

        ];
    }
}
