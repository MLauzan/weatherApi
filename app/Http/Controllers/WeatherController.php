<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function  index()
    {
        return view('home');
    }

    public function get(Request $req)
    {
        if (!$req->has('city')) {
            return redirect()->route('home');
        }

        $req->validate([
            'city' => 'required|min:3'
        ]);

        $query = $req->input('city');
        $key = env('WEATHER_KEY');
        $response = Http::get("https://api.weatherapi.com/v1/forecast.json?key=$key&q=$query&days=7&lang=es&aqi=no&alerts=no");
        $data = $response->json();
        $color = '';
        $background = '';

        if ($data['current']['is_day']) {
            $color = 'dark';
            $background = 'white';
        } else {
            $color = 'white';
            $background = 'dark';
        }
        if (isset($data['error'])) {
            echo ('Ingresa una ciudad válida');
        } else {
            return view('weather', compact('data', 'color', 'background'));
        }
    }
}
