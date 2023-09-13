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
        return response()->json(data: $guilds);
    }


    public function store(StoreGuildRequest $request): JsonResponse
    {
        $guildData = $request->validated();
        $guild = new Guild();
        $guild->server_id = $guildData['server_id'];
        $guild->name = $guildData['name'];
        $guild->description = $guildData['description'];
        $isGuildCreated = $guild->save();

        if(!$isGuildCreated){
            return response()->json('An error occurred', 500);
        }
        return response()->json(['message' => 'Guild stored with successful'], 201);
    }

    public function show(Guild $guild): JsonResponse
    {
        return response()->json(data: $guild);
    }

    public function update(UpdateGuildRequest $request, Guild $guild)
    {

        $guildNewData = $request->validated();
        if (!$guildNewData) {
            return response()->json(['message' => 'Guild updated with successful']);
        }
        $guildUpdated = $guild->update($guildNewData);

        if (!$guildUpdated) {
            return response()->json('An error occurred', 500);
        }

        return response()->json(['message' => 'Guild updated with successful'], 201);
    }

    public function destroy(Guild $guild): JsonResponse
    {
        $guildDeleted = $guild->delete();

        if (!$guildDeleted) {
            return response()->json('An error occurred', 500);
        }

        return response()->json(['message' => 'Guild deleted with successful'], 201);
    }
}
