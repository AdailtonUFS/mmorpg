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
        return War::create($warData);
    }

    public function update(War $war, array $newWarData): void
    {
        $war->update($newWarData);
    }

    public function delete(War $war): void
    {
        $war->delete();
    }
}
