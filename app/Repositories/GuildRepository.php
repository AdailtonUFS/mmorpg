<?php

namespace App\Repositories;

use App\Models\Guild;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GuildRepository
{
    public function fetch(array $filters): LengthAwarePaginator
    {
        return Guild::query()
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', '%' . $filters['name'] . '%');
            })->when(isset($filters['server']), function ($query) use ($filters) {
                return $query->where('server_id', $filters['server']);
            })->when(isset($filters['level']), function ($query) use ($filters) {
                return $query->where('level', $filters['level']);
            })
            ->paginate($filters['perPage'] ?? 10);
    }
    public function create(array $guildData): Guild
    {
        return Guild::create($guildData);
    }

    public function update(Guild $guild, array $newGuildData): void
    {
        $guild->update($newGuildData);
    }

    public function delete(Guild $guild): void
    {
        $guild->delete();
    }
}
