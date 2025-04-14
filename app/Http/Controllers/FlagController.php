<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlagController extends Controller
{
    public function uploadFlag(Request $request, Country $country)
    {
        $request->validate([
            'flag' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($country->flag_url && Storage::exists('flags/' . basename($country->flag_url))) {
            Storage::delete('flags/' . basename($country->flag_url));
        }

        $path = $request->file('flag')->store('flags', 'public');
        $country->flag_url = Storage::url($path);
        $country->save();

        return response()->json([
            'message' => 'Flag uploaded successfully',
            'flag_url' => $country->flag_url
        ]);
    }

    public function getFlag(Country $country)
    {
        if (!$country->flag_url) {
            return response()->json([
                'message' => 'No flag found for this country'
            ], 404);
        }

        $flagPath = 'flags/' . basename($country->flag_url);
        
        if (!Storage::exists($flagPath)) {
            return response()->json([
                'message' => 'Flag file not found'
            ], 404);
        }

        return Storage::download($flagPath);
    }
}