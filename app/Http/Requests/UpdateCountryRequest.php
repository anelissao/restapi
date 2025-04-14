<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('countries')->ignore($this->route('country')),
            ],
            'capital' => 'sometimes|string|max:255',
            'population' => 'sometimes|integer',
            'region' => 'sometimes|string|max:255',
            'subregion' => 'nullable|string|max:255',
            'flag_url' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'motto' => 'nullable|string|max:255',
        ];
    }
}