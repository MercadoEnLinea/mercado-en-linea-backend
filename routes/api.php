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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});







Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'] );
Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'] );
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'] );
Route::delete('/categories', [\App\Http\Controllers\CategoryController::class, 'delete'] );
