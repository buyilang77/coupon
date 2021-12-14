<?php


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

use App\Http\Controllers\RechargeCard\CheckController;
use App\Http\Controllers\RechargeCard\ProductsController;

Route::get('{username}/products', [ProductsController::class, 'index']);
Route::get('products/{product}', [ProductsController::class, 'show']);
Route::post('{product}/check-card', [CheckController::class, 'check']);
Route::post('orders', [CheckController::class, 'store']);
