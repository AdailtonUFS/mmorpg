<?php

namespace App\Models;

use App\Enums\AccountStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "status"
    ];
}
