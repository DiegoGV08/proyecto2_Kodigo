<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('category', CategoryController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('client', ClientController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('order', OrderController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('product', ProductController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('user', UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

});




Route::post('/login', [LoginController::class, "loginprocess"]);

