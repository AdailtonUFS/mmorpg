<?php

namespace App\Http\Requests\API\Server;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:45'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'A name does not contain numbers',
            'name.max' => 'The name cannot be longer than 45 characters',
        ];
    }
}
