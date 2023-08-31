<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Character;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'class_id' => Classes::factory(),
            'name' => fake()->name(),
            'level' => fake()->numberBetween(0, 500),
            'damage' => fake()->randomFloat(2, 0, 1000),
            'defense' => fake()->randomFloat(2, 0, 1000),
            'resistance' => fake()->randomFloat(2, 0, 1000),
            'critical' => fake()->randomFloat(2, 0, 1000),
            'life' => fake()->randomFloat(2, 0, 1000),
            'honor' => fake()->numberBetween(0, 500),
            'description' => fake()->text(255),
        ];
    }
}
