<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MainController;

Route::get('/', [MainController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
});
