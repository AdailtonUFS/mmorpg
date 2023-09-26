<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:255'
            ],
            'email' => [
                'nullable',
            ],
            'perPage' => [
                'nullable',
                'integer'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'A name does not contain numbers',
            'name.max' => 'The name cannot be longer than 255 characters',
            'perPage.integer' => 'The perPage is a number',
        ];
    }
}
