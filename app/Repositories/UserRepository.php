<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $userData): User
    {
        return User::create($userData);
    }

    public function update(User $user, array $newUserData): void
    {
        $user->update($newUserData);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
