<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $account_id
 * @property integer $item_id
 * @property int $quantity
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AccountItem extends Model
{
    use HasFactory;

    protected $table = 'account_item';
}
