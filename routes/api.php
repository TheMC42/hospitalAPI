<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register', [\App\Http\Controllers\API\PassportAuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('pacientes',[ \App\Http\Controllers\API\PacienteController::class, 'index']);
    Route::get('pacientes/{id}',[ \App\Http\Controllers\API\PacienteController::class, 'show']);
    Route::post('pacientes',[ \App\Http\Controllers\API\PacienteController::class, 'store']);
    Route::put('pacientes/{id}',[ \App\Http\Controllers\API\PacienteController::class, 'update']);
});
Route::middleware('auth:api')->group( function () {
    Route::get('doctores',[ \App\Http\Controllers\API\DoctorController::class, 'index']);
    Route::get('doctores/{id}',[ \App\Http\Controllers\API\DoctorController::class, 'show']);
    Route::post('doctores',[ \App\Http\Controllers\API\DoctorController::class, 'store']);
    Route::put('doctores/{id}',[ \App\Http\Controllers\API\DoctorController::class, 'update']);
});
Route::middleware('auth:api')->group( function () {
    Route::get('oficinas',[ \App\Http\Controllers\API\OficinaController::class, 'index']);
    Route::get('oficinas/{id}',[ \App\Http\Controllers\API\OficinaController::class, 'show']);
    Route::post('oficinas',[ \App\Http\Controllers\API\OficinaController::class, 'store']);
    Route::put('oficinas/{id}',[ \App\Http\Controllers\API\OficinaController::class, 'update']);
});
Route::middleware('auth:api')->group( function () {
    Route::get('citas',[ \App\Http\Controllers\API\CitaMedicaController::class, 'index']);
    Route::get('citas/{id}',[ \App\Http\Controllers\API\CitaMedicaController::class, 'show']);
    Route::post('citas',[ \App\Http\Controllers\API\CitaMedicaController::class, 'store']);
    Route::put('citas/{id}',[ \App\Http\Controllers\API\CitaMedicaController::class, 'update']);
});

Route::middleware('auth:api')->group( function () {
    Route::get('diagnosticos',[ \App\Http\Controllers\API\DiagnosticoController::class, 'index']);
    Route::get('diagnosticos/{id}',[ \App\Http\Controllers\API\DiagnosticoController::class, 'show']);
    Route::post('diagnosticos',[ \App\Http\Controllers\API\DiagnosticoController::class, 'store']);
    Route::put('diagnosticos/{id}',[ \App\Http\Controllers\API\DiagnosticoController::class, 'update']);
});
