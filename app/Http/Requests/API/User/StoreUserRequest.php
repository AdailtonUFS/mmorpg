<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cpf' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users',
            'password' => 'required'
        ];
    }
}
