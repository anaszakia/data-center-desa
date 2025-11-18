<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API CRUD Penduduk

// Middleware manual untuk validasi token dari .env
use App\Http\Middleware\ApiManualTokenMiddleware;

Route::middleware(ApiManualTokenMiddleware::class)->group(function () {
    Route::get('/penduduk', [PendudukController::class, 'apiIndex']);
    Route::get('/penduduk/{penduduk}', [PendudukController::class, 'apiShow']);
    Route::post('/penduduk', [PendudukController::class, 'apiStore']);
    Route::put('/penduduk/{penduduk}', [PendudukController::class, 'apiUpdate']);
    Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'apiDestroy']);
});

