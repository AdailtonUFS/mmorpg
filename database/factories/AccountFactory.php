<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $server_id = $this->getServer();
        $user_cpf = $this->getUser();

        return [
            'user_cpf' => $user_cpf,
            'server_id' => $server_id,
            'status' => fake()->randomElement(['active', 'banned', 'inactive']),
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

    public function getUser(): string
    {
        $user_cpf = User::inRandomOrder()->first('cpf')->cpf;

        if (!$user_cpf) {
            $user_cpf = User::factory()->create()->cpf;
        }
        return $user_cpf;
    }

    public function configure(): Factory|AccountFactory
    {
        return $this->afterMaking(function (Account $account) {
            $existingAccount = Account::where('user_cpf', $account->user_cpf)
                ->where('server_id', $account->server_id)
                ->first();

            while ($existingAccount) {
                $account->user_cpf = $this->getUser();
                $account->server_id = $this->getServer();
                $existingAccount = Account::where('user_cpf', $account->user_cpf)
                    ->where('server_id', $account->server_id)
                    ->first();
            }
        });
    }
}
