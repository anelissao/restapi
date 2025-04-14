<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function store(StoreCountryRequest $request)
    {
        $validated = $request->validated();
        $country = Country::create($validated);
        
        return response()->json([
            'message' => 'Country created successfully',
            'country' => $country
        ], 201);
    }

    public function show(Country $country)
    {
        return response()->json($country);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $validated = $request->validated();
        $country->update($validated);
        
        return response()->json([
            'message' => 'Country updated successfully',
            'country' => $country
        ]);
    }

    public function destroy(Country $country)
    {
        $country->delete();
        
        return response()->json([
            'message' => 'Country deleted successfully'
        ]);
    }
}