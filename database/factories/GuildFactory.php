<?php

namespace Database\Factories;

use App\Models\Guild;
use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guild>
 */
class GuildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $server_id = $this->getServer();

        return [
            'server_id' => $server_id,
            'name' => fake()->name(),
            'level' => fake()->numberBetween(0, 500),
            'shield_file_url' => fake()->imageUrl(),
            'description' => fake()->text(255),
        ];
    }

    public function getServer(): int
    {
        $server_id = Server::inRandomOrder()->first('id')->id;

        if (!$server_id) {
            $server_id = Server::factory()->create()->id;
        }
        return $server_id;
    }
}
