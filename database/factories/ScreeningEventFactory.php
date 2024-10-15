<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScreeningEvent>
 */
class ScreeningEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $moviesCount = Movie::count();

        return [
            'movie_id' => fake()->numberBetween(1, $moviesCount),
            'available_seats' => fake()->numberBetween(1, 100),
            'time' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
