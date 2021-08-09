<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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
Passport::routes();



Route::post('/register', [\App\Http\Controllers\AuthenticationController::class, 'register']);
Route::post('/contact/verify', [\App\Http\Controllers\AuthenticationController::class, 'verifyChannel'])->middleware('auth:api');

Route::post('/authenticate', [\App\Http\Controllers\AuthenticationController::class, 'createToken']);
