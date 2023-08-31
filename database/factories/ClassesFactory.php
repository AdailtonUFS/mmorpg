<?php

namespace Database\Factories;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'difficulty' => fake()->randomElement(['easy', 'medium', 'hard']),
            'description' => fake()->text(255)
        ];
    }
}
