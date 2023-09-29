<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Guild\IndexGuildRequest;
use App\Http\Requests\API\Guild\StoreGuildRequest;
use App\Http\Requests\API\Guild\UpdateGuildRequest;
use App\Http\Resources\Guild\GuildCollection;
use App\Http\Resources\Guild\GuildResource;
use App\Models\Guild;
use App\Services\GuildService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GuildController extends Controller
{
    private GuildService $guildService;

    public function __construct(GuildService $guildService)
    {
        $this->guildService = $guildService;
    }

    public function index(IndexGuildRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $guilds = $this->guildService->fetch($filters);

        return (new GuildCollection($guilds))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreGuildRequest $request): JsonResponse
    {
        $guildData = $request->validated();
        $guild = $this->guildService->create($guildData);

        return (new GuildResource($guild))
            ->response()
            ->header('Location', route('guilds.show', $guild))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Guild $guild): JsonResponse
    {
        return (new GuildResource($guild))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateGuildRequest $request, Guild $guild): JsonResponse
    {

        $guildNewData = $request->validated();
        $guild = $this->guildService->update($guild, $guildNewData);

        return (new GuildResource($guild))
            ->response()
            ->header('Location', route('guilds.show', $guild))
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Guild $guild): JsonResponse
    {
        $this->guildService->delete($guild);
        return response()->json(null, status: Response::HTTP_NO_CONTENT);
    }
}
