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

use App\Http\Controllers\Shop\CouponsController;
use App\Http\Controllers\Shop\ShopOrdersController;

Route::get('coupons', [CouponsController::class, 'index']);
Route::get('coupons/{coupon}', [CouponsController::class, 'show']);
Route::resource('orders', ShopOrdersController::class);
