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
            'cpf' => 'nullable|unique:users',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|unique:users',
            'password' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'A name does not contain numbers',
            'name.max' => 'The name cannot be longer than 255 characters',
            'cpf.unique' => 'Cpf already exists',
            'email.unique' => 'Email already exists',
        ];
    }
}
