<?php

namespace App\Services;

use App\Models\Server;
use App\Repositories\ServerRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class ServerService
{
    private ServerRepository $serverRepository;

    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function fetch(array $filters): LengthAwarePaginator
    {
        return $this->serverRepository->fetch($filters);
    }

    public function create(array $serverData): Server
    {
        return $this->serverRepository->create($serverData);
    }

    public function update(Server $server, array $newServerData): Server
    {
        $this->serverRepository->update($server, $newServerData);
        return $server;
    }

    public function delete(Server $server): void
    {
        $this->serverRepository->delete($server);
    }
}
