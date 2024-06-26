<?php

namespace App\Http\Requests;

use App\Models\Enums\JobLogJobType;
use Illuminate\Validation\Rule;

class JobLogGetActionRequest extends BaseActionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::in(['list'])],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'type' => ['sometimes', 'string', Rule::in([JobLogJobType::REFRESH_GEO_POLYGONS])]
        ];
    }
}
