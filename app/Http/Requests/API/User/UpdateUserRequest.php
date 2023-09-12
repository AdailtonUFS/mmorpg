<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cpf' => 'nullable',
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable'
        ];
    }
}
