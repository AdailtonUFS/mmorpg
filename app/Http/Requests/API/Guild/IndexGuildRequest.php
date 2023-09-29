<?php

namespace App\Http\Requests\API\Guild;

use Illuminate\Foundation\Http\FormRequest;

class IndexGuildRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'server' => [
                'nullable',
            ],
            'name' => [
                'nullable',
                'max:50'
            ],
            'level' => [
                'nullable',
                'integer'
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
            'name.max' => 'The guild name cannot be longer than 50 characters',
            'level.integer' => 'The level is not a number',
            'perPage.integer' => 'The perPage is not a number'
        ];
    }
}
