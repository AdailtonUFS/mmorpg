<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Friendship>
 */
class FriendshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id_1' => Account::factory(),
            'account_id_2' => Account::factory()
        ];
    }

    public function configure(): Factory|AccountFactory
    {
        return $this->afterMaking(function (Friendship $friendship) {
            $existingFriendship = Friendship::where('account_id_1', $friendship->account_id_1)
                ->where('account_id_2', $friendship->account_id_2)
                ->first();

            while ($existingFriendship) {
                $friendship->account_id_1 = Account::factory();
                $friendship->account_id_2 = Account::factory();
                $existingFriendship = Account::where('user_cpf', $friendship->account_id_1)
                    ->where('server_id', $friendship->account_id_2)
                    ->first();
            }
        });
    }
}
