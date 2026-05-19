<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\WeatherController as WeatherV1Controller;

Route::group([
    'prefix' => 'v1/weather',
    'as' => 'v1.weather.',
], function () {
    Route::get('/', [WeatherV1Controller::class, 'index'])->name('index');
});
