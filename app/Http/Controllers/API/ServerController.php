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
        return response()->json(data: $servers);
    }

    public function store(StoreServerRequest $request): JsonResponse
    {
        $serverData = $request->validated();
        $server = new Server();
        $server->name = $serverData['name'];
        $serverCreated = $server->save();

        if (!$serverCreated) {
            return response()->json('An error occurred', 500);
        }
        return response()->json(['message' => 'Server stored with successful'], 201);
    }

    public function show(Server $server): JsonResponse
    {
        return response()->json(data: $server);
    }

    public function update(UpdateServerRequest $request, Server $server): JsonResponse
    {
        $serverNewData = $request->validated();
        dump($serverNewData);
        if (!$serverNewData) {
            return response()->json(['message' => 'Server updated with successful']);
        }
        $serverUpdated = $server->update($serverNewData);

        if (!$serverUpdated) {
            return response()->json('An error occurred', 500);
        }

        return response()->json(['message' => 'Server updated with successful'], 201);
    }

    public function destroy(Server $server): JsonResponse
    {
        $serverDeleted = $server->delete();

        if (!$serverDeleted) {
            return response()->json('An error occurred', 500);
        }

        return response()->json(['message' => 'Server deleted with successful'], 201);
    }
}
