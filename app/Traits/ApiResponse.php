<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait ApiResponse
{

    protected function allResponse(Collection $collection, int $code = 200): JsonResponse
    {
        return $this->successResponse($collection, $code);
    }

    protected function successResponse($data, int $code = 200): JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function showResponse(Model $instance, $code = 200): JsonResponse
    {
        return $this->successResponse($instance, $code);
    }

    protected function storedResponse(bool $isStored, string $resource): JsonResponse
    {
        if (!$isStored) {
            return $this->errorResponse("An error occurred", 500);
        }
        return $this->successResponse(["$resource stored with successful"], 201);
    }

    protected function errorResponse(string $message, $code): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function updatedResponse(bool $is_updated, string $resource): JsonResponse
    {
        if (!$is_updated) {
            return $this->errorResponse("An error occurred", 500);
        }
        return $this->updateResponse($resource);
    }

    protected function updateResponse(string $resource): JsonResponse
    {
        return $this->successResponse(["message" => "$resource updated with successful"], 200);
    }

    protected function deletedResponse(bool $is_deleted, string $resource): JsonResponse
    {
        if (!$is_deleted) {
            return $this->errorResponse("An error occurred", 500);
        }
        return $this->successResponse(["message" => "$resource deleted with successful"], 201);
    }


}
