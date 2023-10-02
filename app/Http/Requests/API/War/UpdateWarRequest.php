<?php

namespace App\Http\Requests\API\War;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:45'],
            'guilds' => 'array',
            'guilds.*' => ['integer', 'exists:App\Models\Guild,id']
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'The name cannot be longer than 45 characters',
        ];
    }
}
