<?php

namespace App\Repositories;

use App\Models\War;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WarRepository
{
    public function fetch(array $filters): LengthAwarePaginator
    {
        return War::query()
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', '%' . $filters['name'] . '%');
            })
            ->paginate($filters['perPage'] ?? 10);
    }

    public function create(array $warData): War
    {
        $war = War::create($warData);
        if ($warData['guilds']){
            $war->guilds()->attach($warData['guilds']);
        }
        return $war;
    }

    public function update(War $war, array $newWarData): void
    {
        if ($newWarData['guilds']){
            $war->guilds()->sync($newWarData['guilds']);
        }
        $war->update($newWarData);
    }

    public function delete(War $war): void
    {
        $war->delete();
    }
}
