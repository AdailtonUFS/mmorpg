<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $account_id
 * @property integer $class_id
 * @property string $name
 * @property positive-int $level
 * @property float $damage
 * @property float $defense
 * @property float $resistance
 * @property float $critical
 * @property float $life
 * @property positive-int $honor
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Character extends Model
{
    use HasFactory;
}
