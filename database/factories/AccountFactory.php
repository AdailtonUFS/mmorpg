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
        return [
            'user_cpf' => User::factory(),
            'server_id' => Server::factory(),
            'status' => fake()->randomElement(['active', 'banned', 'inactive']),
        ];
    }

    public function configure(): Factory|AccountFactory
    {
        return $this->afterMaking(function (Account $account) {
            $existingAccount = Account::where('user_cpf', $account->user_cpf)
                ->where('server_id', $account->server_id)
                ->first();

            while ($existingAccount) {
                $account->user_cpf = User::factory();
                $account->server_id = Server::factory();
                $existingAccount = Account::where('user_cpf', $account->user_cpf)
                    ->where('server_id', $account->server_id)
                    ->first();
            }
        });
    }
}
