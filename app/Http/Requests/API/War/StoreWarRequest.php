<?php

namespace App\Http\Requests\API\War;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:45'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'The name cannot be longer than 45 characters',
        ];
    }
}
