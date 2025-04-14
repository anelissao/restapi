<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:countries',
            'capital' => 'required|string|max:255',
            'population' => 'required|integer',
            'region' => 'required|string|max:255',
            'subregion' => 'nullable|string|max:255',
            'flag_url' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'motto' => 'nullable|string|max:255',
        ];
    }
}
