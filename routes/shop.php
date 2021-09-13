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

use App\Http\Controllers\Shop\AuthorizationsController;
use App\Http\Controllers\Shop\CouponsController;
use App\Http\Controllers\Shop\ShopOrdersController;
use App\Http\Controllers\Shop\UsersController;

Route::get('coupons', [CouponsController::class, 'index']);
Route::get('authorizations/wechat', [AuthorizationsController::class, 'oauth']);
Route::get('authorizations/wechat/callback', [AuthorizationsController::class, 'callback']);
Route::get('coupons/{coupon}', [CouponsController::class, 'show']);
Route::middleware('auth:shop-api')->group(function() {
    // 当前登录用户信息
    Route::get('user', [UsersController::class, 'mine']);
    Route::post('orders/pickup/{order}', [ShopOrdersController::class, 'pickup']);
    Route::get('orders/received', [ShopOrdersController::class, 'received']);
    Route::get('orders/received/{order}', [ShopOrdersController::class, 'receivedDetail']);
    Route::resource('orders', ShopOrdersController::class);
});
Route::post('payment/notify',[ShopOrdersController::class, 'notify']);
