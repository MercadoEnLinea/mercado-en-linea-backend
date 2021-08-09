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




Route::get('/transactions',  [\App\Http\Controllers\TransactionController::class, 'index'] );
Route::get('/transactions/{transaction}',  [\App\Http\Controllers\TransactionController::class, 'show'] );
Route::post('/transactions/{transaction}/review',  [\App\Http\Controllers\TransactionController::class, 'review'] )->middleware('auth:api');
Route::post('/purchase',  [\App\Http\Controllers\TransactionController::class, 'purchase'] )->middleware('auth:api');
