<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
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
            'damage' => fake()->randomFloat(2, 0, 1000),
            'defense' => fake()->randomFloat(2, 0, 1000),
            'resistance' => fake()->randomFloat(2, 0, 1000),
            'critical' => fake()->randomFloat(2, 0, 1000),
            'life' => fake()->randomFloat(2, 0, 1000),
            'rarity' => fake()->text(50),
            'description' => fake()->text(255),
        ];
    }
}
