<?php

namespace App\Http\Requests;

use App\Models\StatusEnums\JobLogJobType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class JobLogGetActionRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag);
    }
}
