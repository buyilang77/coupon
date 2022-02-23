<?php

use App\Http\Controllers\Merchant\ActivitiesController;
use App\Http\Controllers\Merchant\AuthorizationsController;
use App\Http\Controllers\Merchant\CouponsController;
use App\Http\Controllers\Merchant\CouponsItemsController;
use App\Http\Controllers\Merchant\ElectronicCardTemplateController;
use App\Http\Controllers\Merchant\RechargeCardController;
use App\Http\Controllers\Merchant\RechargeCardItemsController;
use App\Http\Controllers\Merchant\ExportController;
use App\Http\Controllers\Merchant\LogisticsCompaniesController;
use App\Http\Controllers\Merchant\OrdersController;
use App\Http\Controllers\Merchant\ProductsController;
use App\Http\Controllers\Merchant\RechargeCardOrdersController;
use App\Http\Controllers\Merchant\StoresController;
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
Route::post('users', [UsersController::class, 'store']);
// 登录
Route::post('authorizations', [AuthorizationsController::class, 'store']);
// 刷新token
Route::put('authorizations/current', [AuthorizationsController::class, 'update']);
// 删除token
Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy']);
// 登录后可以访问的接口
Route::get('coupons/qrcode/{item}', [ActivitiesController::class, 'qrcode'])->name('coupons.qrcode');

Route::middleware('auth:merchant-api')->group(function() {
    // 当前登录用户信息
    Route::get('user', [UsersController::class, 'mine']);
    // 编辑登录用户信息
    Route::patch('user', [UsersController::class, 'update']);
    Route::resource('activities', ActivitiesController::class);

    Route::resource('recharge-card/orders', RechargeCardOrdersController::class);

    Route::resource('recharge-card', RechargeCardController::class);
    Route::get('recharge-card/{item}/items', [RechargeCardItemsController::class, 'index']);
    Route::post('recharge-card/{item}/items', [RechargeCardItemsController::class, 'store']);
    Route::patch('recharge-card/items/bulk-update', [RechargeCardItemsController::class, 'bulkUpdate']);
    Route::patch('recharge-card/items/{item}', [RechargeCardItemsController::class, 'update']);
    Route::get('export/recharge-card/{item}', [ExportController::class, 'rechargeCardItem']);
    Route::resource('coupons', CouponsController::class);
    Route::get('coupons/{coupon}/items', [CouponsItemsController::class, 'index']);
    Route::resource('products', ProductsController::class);
    Route::resource('stores', StoresController::class);
    Route::patch('coupons/items/bulk-update', [CouponsItemsController::class, 'bulkUpdate']);
    Route::patch('coupons/items/{item}', [CouponsItemsController::class, 'update']);
    Route::resource('logistics-companies', LogisticsCompaniesController::class);
    Route::resource('orders', OrdersController::class);
    Route::patch('orders/{order}/shipment', [OrdersController::class, 'ship']);
    Route::get('shop-orders', [OrdersController::class, 'shopIndex']);
    Route::post('upload-image', [UploadController::class, 'store']);
    Route::post('import/coupon/{coupon}/item', [UploadController::class, 'importCouponItem']);
    Route::post('import/recharge-card/{card}/item', [UploadController::class, 'importRechargeCard']);
    Route::get('exports/order', [ExportController::class, 'order']);
    Route::get('export/{coupon}/item', [ExportController::class, 'couponItem']);
    Route::get('import/template/recharge-card', [ExportController::class, 'rechargeCardTemplate']);
    Route::get('import/template', [ExportController::class, 'couponItemTemplate']);

    Route::resource('electronic-card-template', ElectronicCardTemplateController::class);
});
