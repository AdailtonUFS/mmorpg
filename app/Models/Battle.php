<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Battle extends Model
{
    use HasFactory;
}
