<?php

namespace App\Repositories;

use App\Models\Server;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ServerRepository
{
    public function fetch(array $filters): LengthAwarePaginator
    {
        return Server::query()
            ->with('current_status')
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', '%' . $filters['name'] . '%');
            })
            ->paginate($filters['perPage'] ?? 10);
    }
    public function create(array $serverData): Server
    {
        return Server::create($serverData);
    }

    public function update(Server $server, array $newServerData): void
    {
        $server->update($newServerData);
    }

    public function delete(Server $server): void
    {
        $server->delete();
    }
}
