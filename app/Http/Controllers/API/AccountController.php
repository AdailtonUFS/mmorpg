<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Account\StoreAccountRequest;
use App\Http\Requests\API\Account\UpdateAccountRequest;
use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function store(StoreAccountRequest $request): JsonResponse
    {
        $accountData = $request->validated();
        $account = $this->accountService->create($accountData);

        return (new AccountResource($account))
            ->response()
            ->header('Location', route('accounts.show', $account))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Account $account): JsonResponse
    {
        return (new AccountResource($account))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateAccountRequest $request, Account $account): JsonResponse
    {
        $accountNewData = $request->validated();
        $account = $this->accountService->update($account, $accountNewData);

        return (new AccountResource($account))
            ->response()
            ->header('Location', route('accounts.show', $account))
            ->setStatusCode(Response::HTTP_OK);
    }


    public function destroy(Account $account): JsonResponse
    {
        $this->accountService->delete($account);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
