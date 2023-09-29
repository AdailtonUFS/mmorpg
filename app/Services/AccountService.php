<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\AccountRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AccountService
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function fetch(array $filters): LengthAwarePaginator
    {
        return $this->accountRepository->fetch($filters);
    }

    /**
     * @throws Exception
     */
    public function create(array $accountData): Account
    {
        $accountExists = $this->accountRepository->exists($accountData['user_cpf'], $accountData['server_id']);

        if ($accountExists){
            throw new Exception("Account already exists");
        }

        return $this->accountRepository->create($accountData);
    }

    public function update(Account $account, array $newAccountData): Account
    {
        $this->accountRepository->update($account, $newAccountData);
        return $account;
    }

    public function delete(Account $account): void
    {
        $this->accountRepository->delete($account);
    }
}
