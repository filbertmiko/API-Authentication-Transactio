<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;
//use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'api'], function ($router){
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});

Route::group(['middleware' => 'jwt.verify'], function (){
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'userProfile']);
    Route::post('refresh', [UserController::class, 'refreshToken']);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('transactions/{transaction}/items', TransactionItemController::class)
        ->only('store', 'update', 'destroy');
});


