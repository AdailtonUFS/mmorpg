<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Http\Requests\API\UpdateUserRequest;
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
            return response()->json('Algum erro ocorreu');
        }
        return response()->json('Usuário criado com sucesso!');
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(data: $user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();
        if (!$data) {
            return response()->json('Usuário atualizado com sucesso!');
        }
        $userUpdated = $user->update($data);

        if (!$userUpdated) {
            return response()->json('Algum erro ocorreu');
        }
        return response()->json('Usuário atualizado com sucesso!');
    }

    public function destroy(User $user): JsonResponse
    {
        $userDeleted = $user->delete();
        if (!$userDeleted) {
            return response()->json('Algum erro ocorreu');
        }
        return response()->json('Usuário deletado com sucesso!');
    }
}
