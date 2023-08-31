<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $account_id_1
 * @property integer $account_id_2
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Friendship extends Model
{
    use HasFactory;
}
