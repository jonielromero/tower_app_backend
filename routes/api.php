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
/*Route::post('/register', [AuthController::class, 'register']);

// Login de usuario
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    // API para obtener todas las personas
    Route::get('/personas', [PersonaController::class, 'index']);
});*/


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('perfil', fn ($request) => $request->user()->load('roles'));

    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('roles', RolController::class);

    Route::post('usu_roles/assign', [UsuRolController::class, 'assign']);
    Route::post('usu_roles/remove', [UsuRolController::class, 'remove']);
});



