<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $server_id
 * @property string $name
 * @property positive-int $level
 * @property string $shield_file_url
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Guild extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'server_id',
        'shield_file_url',
        'description',
    ];

    public function wars(): BelongsToMany
    {
        return $this->belongsToMany(War::class,'guild_war', 'guild_id', 'war_id')->withTimestamps();
    }
}
