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

use App\Http\Controllers\Frontend\AuthorizationsController;
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
    // 编辑登录用户信息
//    Route::patch('user', [UsersController::class, 'update'])->name('user.update');
//    Route::resource('activities', ActivitiesController::class);
//    Route::resource('coupons', CouponsController::class);
//    Route::get('coupons/{coupon}/items', [CouponsItemsController::class, 'index'])->name('coupons.index');
//    Route::resource('products', ProductsController::class);
//    Route::patch('coupons/items/bulk-update', [CouponsItemsController::class, 'bulkUpdate']);
//    Route::patch('coupons/items/{item}', [CouponsItemsController::class, 'update']);
//    Route::resource('logistics-companies', LogisticsCompaniesController::class);
//    Route::resource('orders', OrdersController::class);
//    Route::patch('orders/{order}/shipment', [OrdersController::class, 'ship'])->name('orders.shipment');
//    Route::post('upload-image', [UploadController::class, 'store'])->name('store');
});
