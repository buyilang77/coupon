<?php

namespace App\Http\Controllers\RechargeCard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Resources\Shop\CouponResource;
use App\Models\Coupon;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsController extends MainController
{
    /**
     * @param string $username
     * @return JsonResponse
     */
    public function index(string $username): JsonResponse
    {
        $merchant = Merchant::where('username', $username)->first();
        $item = QueryBuilder::for($merchant->product())->orderByDesc('id')->allowedFilters(['id'])->paginate($this->perPage);
        return custom_response($item);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return custom_response($product->load('merchant'));
    }
}
