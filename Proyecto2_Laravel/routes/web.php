<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('category', CategoryController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('client', ClientController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('order', OrderController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('order_detail', OrderDetailController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('product', ProductController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('user', UserController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
