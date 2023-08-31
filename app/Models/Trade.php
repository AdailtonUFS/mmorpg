<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $account_item_id_1
 * @property integer $account_item_id_2
 * @property integer|null $offer_id
 * @property float $quantity_item_trade_account_1
 * @property float $quantity_item_trade_account_2
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Trade extends Model
{
    use HasFactory;
}
