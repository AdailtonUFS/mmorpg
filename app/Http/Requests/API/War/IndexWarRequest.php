<?php

namespace App\Http\Requests\API\War;

use Illuminate\Foundation\Http\FormRequest;

class IndexWarRequest extends FormRequest
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
                'max:45'
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
            'name.max' => 'The name cannot be longer than 45 characters',
            'perPage.integer' => 'The perPage is not a number'
        ];
    }
}
