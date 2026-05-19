<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\VisitController;
use App\Http\Controllers\Api\V1\WeatherController as WeatherV1Controller;

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
], function () {
    Route::group([
        'prefix' => 'weather',
        'as' => 'weather.',
    ], function () {
        Route::get('/', [WeatherV1Controller::class, 'index'])->name('index');
    });

    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::options('/visits', [VisitController::class, 'options'])->name('visits.options');
});
