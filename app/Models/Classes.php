<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $difficulty
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Classes extends Model
{
    use HasFactory;

    protected $table = "classes";

}
