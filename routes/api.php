<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use App\Http\Controllers\Api\PersonaController;

// API para obtener la fecha y hora actuales con la zona horaria configurada
Route::get('/datetime', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timezone' => config('app.timezone'),
    ]);
});

// API para obtener todas las personas
Route::get('/personas', [PersonaController::class, 'index']);

