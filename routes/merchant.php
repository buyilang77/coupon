<?php

use App\Http\Controllers\Merchant\ActivitiesController;
use App\Http\Controllers\Merchant\AuthorizationsController;
use App\Http\Controllers\Merchant\CouponsController;
use App\Http\Controllers\Merchant\CouponsItemsController;
use App\Http\Controllers\Merchant\LogisticsCompaniesController;
use App\Http\Controllers\Merchant\OrdersController;
use App\Http\Controllers\Merchant\ProductsController;
use App\Http\Controllers\Merchant\UploadController;
use App\Http\Controllers\Merchant\UsersController;

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
// 用户注册
Route::post('users', [UsersController::class, 'store'])->name('users.store');
// 登录
Route::post('authorizations', [AuthorizationsController::class, 'store'])
    ->name('authorizations.store');
// 刷新token
Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
    ->name('authorizations.update');
// 删除token
Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
    ->name('authorizations.destroy');
// 登录后可以访问的接口
Route::middleware('auth:merchant-api')->group(function() {
    // 当前登录用户信息
    Route::get('user', [UsersController::class, 'mine'])->name('user.show');
    // 编辑登录用户信息
    Route::patch('user', [UsersController::class, 'update'])->name('user.update');
    Route::resource('activities', ActivitiesController::class);
    Route::resource('coupons', CouponsController::class);
    Route::get('coupons/{coupon}/items', [CouponsItemsController::class, 'index'])->name('coupons.index');
    Route::resource('products', ProductsController::class);
    Route::patch('coupons/items/bulk-update', [CouponsItemsController::class, 'bulkUpdate']);
    Route::patch('coupons/items/{item}', [CouponsItemsController::class, 'update']);
    Route::resource('logistics-companies', LogisticsCompaniesController::class);
    Route::resource('orders', OrdersController::class);
    Route::patch('orders/{order}/shipment', [OrdersController::class, 'ship'])->name('orders.shipment');
    Route::post('upload-image', [UploadController::class, 'store'])->name('store');
});
