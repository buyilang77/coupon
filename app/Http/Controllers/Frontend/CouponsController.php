<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\MainController;
use App\Http\Requests\Frontend\CheckRequest;
use App\Http\Resources\Frontend\CouponResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponsController extends MainController
{
    /**
     * Display the specified resource.
     *
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function show(Coupon $coupon): JsonResponse
    {
        return custom_response(CouponResource::make($coupon));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function product(Product $product): JsonResponse
    {
        return custom_response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function item(Request $request): JsonResponse
    {
        $condition = $request->validate([
            'coupon_id' => 'required|integer',
            'code'      => 'required|string',
        ]);
        $item = CouponItem::where($condition)->first();
        return custom_response($item);
    }
}
