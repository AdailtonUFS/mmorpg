<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountItem;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AccountItem>
 */
class AccountItemFactory extends Factory
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
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(0, 9999),
            'status' => fake()->randomElement(['traded', 'won']),
        ];
    }
}
