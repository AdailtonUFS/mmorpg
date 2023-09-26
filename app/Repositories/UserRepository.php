<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{

    public function fetch(array $filters): LengthAwarePaginator
    {
        return User::query()
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', '%' . $filters['name'] . '%');
            })
            ->when(isset($filters['email']), function ($query) use ($filters) {
                return $query->where('email', $filters['email']);
            })
            ->paginate($filters['perPage'] ?? 10);
    }
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
