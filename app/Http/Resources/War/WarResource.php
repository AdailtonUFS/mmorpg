<?php

namespace App\Http\Resources\War;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        $withGuilds = $request->get('with_guilds');
        if ($withGuilds != null){
            $data['guilds'] = $this->guilds->toArray();
        }
        return $data;
    }
}
