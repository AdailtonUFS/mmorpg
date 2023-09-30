<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string $id
 * @property string $name
 * @property float $damage
 * @property float $defense
 * @property float $resistance
 * @property float $critical
 * @property float $life
 * @property string $rarity
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Item extends Model
{
    use HasFactory;
}
