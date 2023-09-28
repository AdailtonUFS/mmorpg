<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Server\IndexServerRequest;
use App\Http\Requests\API\Server\StoreServerRequest;
use App\Http\Requests\API\Server\UpdateServerRequest;
use App\Http\Resources\Server\ServerCollection;
use App\Http\Resources\Server\ServerResource;
use App\Models\Server;
use App\Services\ServerService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ServerController extends Controller
{
    private ServerService $serverService;

    public function __construct(ServerService $serverService)
    {
        $this->serverService = $serverService;
    }

    public function index(IndexServerRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $servers = $this->serverService->fetch($filters);
        return (new ServerCollection($servers))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreServerRequest $request): JsonResponse
    {
        $serverData = $request->validated();
        $server = $this->serverService->create($serverData);

        return (new ServerResource($server))
            ->response()
            ->header('Location', route('servers.show', $server))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Server $server): JsonResponse
    {
        return (new ServerResource($server))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateServerRequest $request, Server $server): JsonResponse
    {
        $serverNewData = $request->validated();
        $this->serverService->update($server, $serverNewData);
        return (new ServerResource($server))
            ->response()
            ->header('Location', route('servers.show', $server))
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Server $server): JsonResponse
    {
        $this->serverService->delete($server);
        return response()->json(null, status: Response::HTTP_NO_CONTENT);
    }
}
