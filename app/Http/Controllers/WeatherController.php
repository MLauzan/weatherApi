<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
  public function get(Request $req)
    {
        $query = $req->input('city');
        $key = env('WEATHER_KEY');
        $url = env('WEATHER_URL');

        $response = Http::get("$url/forecast.json?key=$key&q=$query&days=7&lang=es&alerts=no");
        $data = $response->json();
        $statusCode = $response->status();

        $req->validate([
            'city' => 'required|min:3'
        ]);

        if (isset($data['error'])) {
            return response()->json(['error', $data['error']['message']], $statusCode);
        } else {
            return response()->json(['weather', $data], $statusCode);
        }
    }
}
