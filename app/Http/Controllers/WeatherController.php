<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    public function get(Request $req)
    {
        $query = $req->input('city');
        $key = env('WEATHER_KEY');
        $url = env('WEATHER_URL');

        $response = Http::get("$url/forecast.json?key=$key&q=$query&aqi=yes&days=7&lang=es&alerts=no");
        $data = $response->json();
        $statusCode = $response->status();

        $validator = Validator::make($req->all(), [
            'city' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors', $validator->errors()], 422);
        }

        if (isset($data['error'])) {
            return response()->json(['error', $data['error']['message']], $statusCode);
        } else {
            return response()->json(['weather', $data], $statusCode);
        }
    }
}
