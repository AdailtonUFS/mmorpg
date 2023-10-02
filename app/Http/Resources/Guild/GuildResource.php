<?php

namespace App\Http\Resources\Guild;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'server_id' => $this->server_id,
            'shield_file_url' => $this->shield_file_url,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        $withWars = $request->get('wars');
        if ($withWars != null){
            $data['wars'] = $this->wars->toArray();
        }
        return $data;
    }
}
