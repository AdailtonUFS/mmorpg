<?php

namespace App\Models;

use App\Enums\AccountStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $server_id
 * @property string $user_cpf
 * @property AccountStatus $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "user_cpf",
        "server_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_cpf', 'cpf');
    }
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }
}
