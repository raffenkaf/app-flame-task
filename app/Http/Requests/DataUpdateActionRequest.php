<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class DataUpdateActionRequest extends BaseActionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(['refresh'])],
            'delaySeconds' => ['sometimes', 'integer', 'min:1', 'max:900'],
        ];
    }
}
