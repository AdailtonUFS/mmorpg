<?php

namespace App\Http\Requests\API\Guild;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuildRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'server_id' => 'nullable|exists:App\Models\Server,id',
            'name' => 'nullable|max:50|unique:App\Models\Guild,name',
            'description' => 'nullable|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'server_id.exists' => 'The server_id does not exists',
            'name.max' => 'The guild name cannot be longer than 50 characters',
            'name.unique' => 'The guild name is not available',
            'description.max' => 'The guild description cannot be longer than 255 characters',
        ];
    }
}
