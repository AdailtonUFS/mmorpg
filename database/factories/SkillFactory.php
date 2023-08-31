<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id' => Classes::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(255),
        ];
    }
}
