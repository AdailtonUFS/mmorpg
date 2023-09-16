<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Guild\StoreGuildRequest;
use App\Http\Requests\API\Guild\UpdateGuildRequest;
use App\Models\Guild;
use Illuminate\Http\JsonResponse;

class GuildController extends Controller
{
    public function index(): JsonResponse
    {
        $guilds = Guild::all();
        return $this->allResponse($guilds);
    }

    public function store(StoreGuildRequest $request): JsonResponse
    {
        $guildData = $request->validated();

        $guild = new Guild();
        $guild->server_id = $guildData['server_id'];
        $guild->name = $guildData['name'];
        $guild->description = $guildData['description'];
        $stored = $guild->save();

        return $this->storedResponse($stored, "Guild");
    }

    public function show(Guild $guild): JsonResponse
    {
        return $this->showResponse($guild);
    }

    public function update(UpdateGuildRequest $request, Guild $guild): JsonResponse
    {

        $guildNewData = $request->validated();

        if (!$guildNewData) {
            return $this->updateResponse("Guild");
        }

        $updated = $guild->update($guildNewData);
        return $this->updatedResponse($updated, "Guild");
    }

    public function destroy(Guild $guild): JsonResponse
    {
        $deleted = $guild->delete();
        return $this->deletedResponse($deleted, "Guild");
    }
}
