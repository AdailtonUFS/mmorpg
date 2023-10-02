<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class War extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function guilds(): BelongsToMany
    {
        return $this->belongsToMany(Guild::class)
            ->withTimestamps();
    }
}
