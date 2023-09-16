<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\War\StoreWarRequest;
use App\Http\Requests\API\War\UpdateWarRequest;
use App\Models\War;
use Illuminate\Http\JsonResponse;

class WarController extends Controller
{
    public function index(): JsonResponse
    {
        $wars = War::all();
        return $this->allResponse($wars);
    }

    public function store(StoreWarRequest $request): JsonResponse
    {
        $warData = $request->validated();
        $war = new War();
        $war->name = $warData['name'];
        $stored = $war->save();

        return $this->storedResponse($stored, "War");
    }

    public function show(War $war): JsonResponse
    {
        return $this->showResponse($war);
    }

    public function update(UpdateWarRequest $request, War $war): JsonResponse
    {
        $warNewData = $request->validated();

        if (!$warNewData) {
            return $this->successResponse(['message' => "User updated with successful"]);
        }

        $updated = $war->update($warNewData);
        return $this->updatedResponse($updated, "War");
    }

    public function destroy(War $war): JsonResponse
    {
        $deleted = $war->delete();
        return $this->deletedResponse($deleted, "User");
    }
}
