<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class DataGetActionRequest extends BaseActionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(['search'])],
            'lon' => [Rule::requiredIf($this->action === 'search'), 'numeric', 'max:45', 'min:20'],
            'lat' => [Rule::requiredIf($this->action === 'search'), 'numeric', 'max:60', 'min:40'],
        ];
    }
}
