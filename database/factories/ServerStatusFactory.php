<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\ServerStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServerStatus>
 */
class ServerStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $server = Server::inRandomOrder()->first();

        if (!$server) {
            $server = Server::factory()->create();
        }

        return [
            'server_id' => $server->id,
            'status' => fake()->randomElement(['active', 'deactivated', 'maintenance']),
        ];
    }
}
