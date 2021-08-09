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



Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'] );
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'] );
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'] )->middleware('auth:api');
Route::delete('/products', [\App\Http\Controllers\ProductController::class, 'delete'] );


Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'] );
Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'] );
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'] );
Route::delete('/categories', [\App\Http\Controllers\CategoryController::class, 'delete'] );


