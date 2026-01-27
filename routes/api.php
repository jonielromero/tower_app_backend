<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Auth\AuthController;

// API para obtener la fecha y hora actuales con la zona horaria configurada
Route::get('/datetime', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timezone' => config('app.timezone'),
    ]);
});

// Registro de usuario
Route::post('/register', [AuthController::class, 'register']);

// Login de usuario
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    // API para obtener todas las personas
    Route::get('/personas', [PersonaController::class, 'index']);
});



