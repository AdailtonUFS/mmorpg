<?php

namespace App\Http\Requests\API\Account;

use App\Enums\AccountStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAccountRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'nullable',
                new Enum(AccountStatus::class)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'A status is invalid, account status is active, banned or inactive',
        ];
    }
}
