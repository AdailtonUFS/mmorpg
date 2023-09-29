<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AccountRepository
{
    public function fetch(array $filters): LengthAwarePaginator
    {
        return Account::query()
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', '%' . $filters['name'] . '%');
            })
            ->paginate($filters['perPage'] ?? 10);
    }

    public function create(array $accountData): Account
    {
        return Account::create($accountData);
    }

    public function update(Account $account, array $newAccountData): void
    {
        $account->update($newAccountData);
    }

    public function delete(Account $account): void
    {
        $account->delete();
    }

    public function exists(string $user_cpf, int $server_id): bool
    {
        return Account::
            where("user_cpf", $user_cpf)
            ->where("server_id", $server_id)
            ->count('id') > 0;
    }
}
