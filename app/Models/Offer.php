<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $account_item_id
 * @property string $status
 * @property integer $quantity_offer
 * @property integer $quantity_receive
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Offer extends Model
{
    use HasFactory;

    public function accountItem(): BelongsTo
    {
        return $this->belongsTo(AccountItem::class);
    }
}
