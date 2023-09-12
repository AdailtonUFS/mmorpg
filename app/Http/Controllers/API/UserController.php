<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\Http\Requests\API\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json(data: $users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = new User();
        $user->cpf = $data['cpf'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $userCreated = $user->save();

        if (!$userCreated) {
            return response()->json('An error occurred', 500);
        }
        return response()->json(['message' => 'User stored with successful'], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(data: $user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();
        if (!$data) {
            return response()->json(['message' => 'User updated with successful']);
        }
        $userUpdated = $user->update($data);

        if (!$userUpdated) {
            return response()->json('An error occurred', 500);
        }
        return response()->json(['message' => 'User updated with successful']);
    }

    public function destroy(User $user): JsonResponse
    {
        $userDeleted = $user->delete();

        if (!$userDeleted) {
            return response()->json('An error occurred', 500);
        }
        return response()->json(['message' => 'User deleted with successful']);
    }
}
