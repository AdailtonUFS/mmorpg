<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function fetch(array $filters): LengthAwarePaginator
    {
        return $this->userRepository->fetch($filters);
    }
    public function create(array $userData): User
    {
        $userData['password'] = Hash::make($userData['password']);
        return $this->userRepository->create($userData);
    }

    public function update(User $user, array $newUserData): User
    {
        $this->userRepository->update($user, $newUserData);
        return $user;
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }
}
