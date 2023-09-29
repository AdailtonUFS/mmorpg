<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\War\IndexWarRequest;
use App\Http\Requests\API\War\StoreWarRequest;
use App\Http\Requests\API\War\UpdateWarRequest;
use App\Http\Resources\War\WarCollection;
use App\Http\Resources\War\WarResource;
use App\Models\War;
use App\Services\WarService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WarController extends Controller
{
    private WarService $warService;

    public function __construct(WarService $warService)
    {
        $this->warService = $warService;
    }

    public function index(IndexWarRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $wars = $this->warService->fetch($filters);

        return (new WarCollection($wars))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreWarRequest $request): JsonResponse
    {
        $warData = $request->validated();
        $war = $this->warService->create($warData);

        return (new WarResource($war))
            ->response()
            ->header('Location', route('wars.show', $war))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(War $war): JsonResponse
    {
        return (new WarResource($war))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateWarRequest $request, War $war): JsonResponse
    {
        $warNewData = $request->validated();
        $war = $this->warService->update($war, $warNewData);

        return (new WarResource($war))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(War $war): JsonResponse
    {
        $this->warService->delete($war);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
