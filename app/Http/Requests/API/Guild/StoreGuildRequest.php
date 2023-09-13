<?php

namespace App\Http\Requests\API\Guild;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuildRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'server_id' => 'required|exists:App\Models\Server,id',
            'name' => 'required|max:50|unique:App\Models\Guild,name',
            'description' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'server_id.required' => 'A server_id is required',
            'server_id.exists' => 'The server_id does not exists',
            'name.required' => 'A name is required',
            'name.max' => 'The guild name cannot be longer than 50 characters',
            'name.unique' => 'The guild name is not available',
            'description.required' => 'A description is required',
            'description.max' => 'The guild description cannot be longer than 255 characters',
        ];
    }
}
