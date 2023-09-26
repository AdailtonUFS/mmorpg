<?php

namespace App\Http\Requests\API\User;

use App\Rules\ValidCpf;
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
            'cpf' => [
                'required',
                'unique:users',
                new ValidCpf
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'unique:users'
            ],
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name does not contain numbers',
            'name.max' => 'The name cannot be longer than 255 characters',

            'cpf.required' => 'A cpf is required',
            'cpf.unique' => 'Cpf already exists',

            'email.required' => 'An email is required',
            'email.unique' => 'Email already exists',

            'password.required' => 'A password is required',
        ];
    }
}
