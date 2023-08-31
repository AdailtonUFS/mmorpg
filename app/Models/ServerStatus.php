<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $server_id
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ServerStatus extends Model
{
    use HasFactory;
}
