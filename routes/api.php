<?php

use App\Models\Complaint;
use App\Models\ComplaintMessage;
use App\Models\ContactChannelVerificationCode;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
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


Route::get('/transactions',  [\App\Http\Controllers\TransactionController::class, 'index'] );
Route::get('/transactions/{transaction}',  [\App\Http\Controllers\TransactionController::class, 'show'] );
Route::post('/transactions/{transaction}/review',  [\App\Http\Controllers\TransactionController::class, 'review'] )->middleware('auth:api');
Route::post('/purchase',  [\App\Http\Controllers\TransactionController::class, 'purchase'] )->middleware('auth:api');


Route::get('resset', function (){

    Schema::disableForeignKeyConstraints();
    TransactionReview::truncate();
    Complaint::truncate();
    ComplaintMessage::truncate();
    Transaction::truncate();
    Product::truncate();
    ContactChannelVerificationCode::truncate();
    User::truncate();


    Schema::enableForeignKeyConstraints();
});
