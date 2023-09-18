<?php

namespace App\Http\Requests\API\Account;

use App\Enums\AccountStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_cpf' => [
                'required',
                'string',
                'exists:users,cpf',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                'max:14',
                Rule::unique('accounts')->where(function ($query) {
                    return $query->where('server_id', $this->input('server_id'));
                }),
            ],
            'server_id' => 'required|exists:servers,id',
            'status' => [
                'required',
                new Enum(AccountStatus::class)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_cpf.required' => 'An user_cpf is required',
            'user_cpf.string' => 'An user_cpf is string',
            'user_cpf.exists' => 'The user_cpf does not exists',
            'user_cpf.regex' => 'The format is ###.###.###-##',
            'user_cpf.max' => 'The user cpf cannot be longer than 14 characters',
            'user_cpf.unique' => 'An account already exists on this server',

            'server_id.required' => 'A server_id is required',
            'server_id.exists' => 'The server_id does not exists',

            'status.required' => 'A status is required',
            'status.in' => 'A status is invalid, account status is active, banned or inactive',
        ];
    }
}
