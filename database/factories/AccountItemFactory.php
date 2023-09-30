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
        $account_id = $this->getAccount();
        $item_id = $this->getItem();

        return [
            'account_id' => $account_id,
            'item_id' => $item_id,
            'quantity' => fake()->numberBetween(0, 9999),
            'status' => fake()->randomElement(['traded', 'won']),
        ];
    }

    public function getAccount(): int
    {
        $account_id = Account::inRandomOrder()->first('id')->id;

        if (!$account_id) {
            $account_id = Account::factory()->create()->id;
        }
        return $account_id;
    }

    public function getItem(): int
    {
        $item_id = Item::inRandomOrder()?->first('id')?->id;

        if (!$item_id) {
            $item_id = Item::factory()?->create()?->id;
        }
        return $item_id;
    }
}
