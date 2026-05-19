<?php

namespace App\Http\Resources\V1\Weather;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'weather_time' => $this->weather_time,
            'interval' => $this->interval,
            'temperature' => $this->temperature,
            'windspeed' => $this->windspeed,
            'winddirection' => $this->winddirection,
            'is_day' => $this->is_day,
            'weathercode' => $this->weathercode,
            'created_at' => $this->created_at,
        ];
    }
}
