<?php

namespace Database\Factories;

use App\Models\AccountItem;
use App\Models\Item;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accountItem = AccountItem::factory()->create();

        return [
            'account_item_id' => $accountItem->id,
            'item_id' => Item::factory()->create()->id,
            'status' => fake()->randomElement(['open', 'closed']),
            'quantity_receive' => fake()->numberBetween(0, 9999),
            'quantity_offer' => fake()->numberBetween(0, $accountItem->quantity),
        ];
    }
}
