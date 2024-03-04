<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmpleadoController;


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


Route::get('/empleados', [ EmpleadoController::class, 'index']);
Route::get('/empleados/{id}', [ EmpleadoController::class, 'show']);
Route::post('/empleados', [ EmpleadoController::class, 'store']);
Route::post('/empleados/{id}', [ EmpleadoController::class, 'update']);
Route::delete('empleados/{id}', [ EmpleadoController::class, 'destroy']);
