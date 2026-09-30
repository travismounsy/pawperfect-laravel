<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index'])
    ->name('services.index');

Route::get('/services/create', [ServiceController::class, 'create'])
    ->name('services.create');

Route::post('/services', [ServiceController::class, 'store'])
    ->name('services.store');

Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])
    ->name('services.edit');

Route::put('/services/{service}', [ServiceController::class, 'update'])
    ->name('services.update');

Route::delete('/services/{service}', [ServiceController::class, 'destroy'])
    ->name('services.destroy');