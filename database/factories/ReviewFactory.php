<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $booking = Booking::factory()->create(); // svaki put novi , ovo je zbog toga sto sam stavio 1 review po bookingu

        return [
            'booking_id'  => $booking->id,
            'user_id'     => $booking->user_id,
            'workshop_id' => $booking->workshop_id,
            'rating'      => fake()->numberBetween(3, 5),
            'comment'     => fake()->optional()->sentence(12),
            'is_approved' => true,
        ];
    }
}
