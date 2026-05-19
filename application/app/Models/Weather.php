<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers';

    protected $fillable = [
        'latitude',
        'longitude',
        'weather_time',
        'interval',
        'temperature',
        'windspeed',
        'winddirection',
        'is_day',
        'weathercode',
    ];

    protected $casts = [
        'weather_time' => 'datetime',
        'is_day' => 'boolean',
    ];
}
