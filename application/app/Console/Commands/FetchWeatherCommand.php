<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchWeatherCommand extends Command
{
    protected $signature = 'weather:fetch';

    protected $description = 'Fetch weather data from Open-Meteo API';

    public function handle(): int
    {
        $latitude = 52.276156;
        $longitude = 104.351133;

        $response = Http::timeout(10)->get(
            'https://api.open-meteo.com/v1/forecast',
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current_weather' => true,
            ]
        );

        if ($response->failed()) {
            $this->error('Failed to fetch weather');

            return self::FAILURE;
        }

        $data = $response->json();

        $weather = $data['current_weather'];

        Weather::create([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'weather_time' => $weather['time'],
            'interval' => $weather['interval'],
            'temperature' => $weather['temperature'],
            'windspeed' => $weather['windspeed'],
            'winddirection' => $weather['winddirection'],
            'is_day' => $weather['is_day'],
            'weathercode' => $weather['weathercode'],
        ]);

        $this->info('Weather successfully saved at ' . now()->format('Y-m-d H:i:s'));

        return self::SUCCESS;
    }
}
