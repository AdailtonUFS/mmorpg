<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $name
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function status(): HasMany
    {
        return $this->hasMany(ServerStatus::class);
    }

    public function current_status(): HasOne
    {
        return $this->hasOne(ServerStatus::class)->latest();
    }
}
