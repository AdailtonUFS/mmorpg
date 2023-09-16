<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\StoreUserRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return $this->allResponse($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = new User();
        $user->cpf = $data['cpf'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $stored = $user->save();

        return $this->storedResponse($stored, "User");
    }

    public function show(User $user): JsonResponse
    {
        return $this->showResponse($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $userNewData = $request->validated();

        if (!$userNewData) {
            return $this->updateResponse("User");
        }

        $updated = $user->update($userNewData);
        return $this->updatedResponse($updated, "User");
    }

    public function destroy(User $user): JsonResponse
    {
        $deleted = $user->delete();
        return $this->deletedResponse($deleted, "User");
    }
}
