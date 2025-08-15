<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function index(WeatherService $weatherService)
    {
        $weatherData = $weatherService->getWeather();

        // Ambil 12 data pertama
        $cuacaList = collect($weatherData['list'])->take(12)->map(function ($item) {
            return [
                'time' => date('d M H:i', $item['dt']),
                'temp' => round($item['main']['temp'], 2),
            ];
        });

        return view('cuaca', compact('cuacaList'));
    }
}
