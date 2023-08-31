<?php

namespace Database\Factories;

use App\Models\AccountItem;
use App\Models\Offer;
use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trade>
 */
class TradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $offer = Offer::factory()->create();
        $account_item = AccountItem::factory()->create();
        return [
            'account_item_id_1' => $account_item,
            'account_item_id_2' => $offer->account_item_id,
            'offer_id' => $offer,
            'quantity_item_trade_account_1' => fake()->numberBetween(0, $account_item->quantity),
            'quantity_item_trade_account_2' => fake()->numberBetween(0, $offer?->accountItem?->quantity ?? 100),
        ];
    }
}
