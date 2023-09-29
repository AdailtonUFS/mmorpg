<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user_cpf = $this?->user()?->first()->cpf;
        $server_id = $this?->server()?->first()->id;

        return [
            'id' => $this->id,
            'user' => $user_cpf ? route('users.show', $user_cpf) : '',
            'server' => $server_id ? route('servers.show', $server_id) : '',
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
