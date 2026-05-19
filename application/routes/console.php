<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('weather:fetch')
    ->everyFiveMinutes()
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/weather-' . now()->format('Y-m-d') . '.log'))
;
