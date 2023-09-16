<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Server\StoreServerRequest;
use App\Http\Requests\API\Server\UpdateServerRequest;
use App\Models\Server;
use Illuminate\Http\JsonResponse;

class ServerController extends Controller
{

    public function index(): JsonResponse
    {
        $servers = Server::all();
        return $this->allResponse($servers);
    }

    public function store(StoreServerRequest $request): JsonResponse
    {
        $serverData = $request->validated();

        $server = new Server();
        $server->name = $serverData['name'];
        $stored = $server->save();

        return $this->storedResponse($stored, "Server");
    }

    public function show(Server $server): JsonResponse
    {
        return $this->showResponse($server);
    }

    public function update(UpdateServerRequest $request, Server $server): JsonResponse
    {
        $serverNewData = $request->validated();

        if (!$serverNewData) {
            return $this->updateResponse("Server");
        }

        $updated = $server->update($serverNewData);
        return $this->updatedResponse($updated, "Server");
    }

    public function destroy(Server $server): JsonResponse
    {
        $deleted = $server->delete();
        return $this->deletedResponse($deleted, "Server");
    }
}
