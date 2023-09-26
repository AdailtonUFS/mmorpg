<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\StoreUserRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        $users = User::query()->when()->paginate();

        return (new UserCollection($users))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validatedUserData = $request->validated();
        $user = $this->userService->create($validatedUserData);

        return (new UserResource($user))
            ->response()
            ->header('Location', route('users.show', $user))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user): JsonResponse
    {
        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $userNewData = $request->validated();
        $this->userService->update($user, $userNewData);

        return (new UserResource($user))
            ->response()
            ->header('Location', route('users.show', $user))
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    }

    public function destroy(User $user): Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $user->delete();
        return response(status: Response::HTTP_NO_CONTENT);
    }
}
