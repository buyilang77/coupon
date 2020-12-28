<?php

use App\Http\Controllers\Admin\AuthorizationsController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\UsersController;

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
// 登录
Route::post('authorizations', [AuthorizationsController::class, 'store'])
    ->name('authorizations.store');
// 刷新token
Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
    ->name('authorizations.update');
// 删除token
Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
    ->name('authorizations.destroy');
Route::middleware(['auth:admin-api', 'cors'])->group(function () {
    // 当前登录用户信息
    Route::get('user', [UsersController::class, 'mine']);
    Route::resource('merchants', MerchantsController::class);
});
