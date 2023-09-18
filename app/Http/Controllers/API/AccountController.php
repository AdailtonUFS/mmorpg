<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Account\StoreAccountRequest;
use App\Http\Requests\API\Account\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function store(StoreAccountRequest $request): JsonResponse
    {
        $accountData = $request->validated();

        $account = new Account();
        $account->user_cpf = $accountData['user_cpf'];
        $account->server_id = $accountData['server_id'];
        $account->status = $accountData['status'];
        $stored = $account->save();

        return $this->storedResponse($stored, "Account");
    }

    public function show(Account $account): JsonResponse
    {
        return $this->showResponse($account);
    }

    public function update(UpdateAccountRequest $request, Account $account): JsonResponse
    {
        $accountNewData = $request->validated();

        if (!$accountNewData) {
            return $this->updateResponse("Account");
        }

        $updated = $account->update($accountNewData);
        return $this->updatedResponse($updated, "Account");
    }


    public function destroy(Account $account): JsonResponse
    {
        $deleted = $account->delete();
        return $this->deletedResponse($deleted, "Account");
    }
}
