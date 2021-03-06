<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CafeteriaController;
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

//Route::post('/login', [AuthController::class, 'login']);
//
//
//Route::middleware('sanctum:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/cafeteria', [CafeteriaController::class, 'index']);
Route::post('/cafeteria', [CafeteriaController::class, 'store']);

