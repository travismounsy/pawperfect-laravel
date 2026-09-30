<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index'])
    ->name('services.index');

Route::get('/services/create', [ServiceController::class, 'create'])
    ->name('services.create');

Route::post('/services', [ServiceController::class, 'store'])
    ->name('services.store');