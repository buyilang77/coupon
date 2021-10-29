<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\MainController;
use App\Http\Requests\Frontend\CheckRequest;
use App\Http\Resources\Frontend\CouponResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

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
     * @param CheckRequest $request
     * @return JsonResponse
     */
    public function check(CheckRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['redemption_status'] = 0;
        $couponItem = CouponItem::where($data)->first();
        if (!$couponItem instanceof CouponItem) {
            return custom_response(['status' => false]);
        }
        return custom_response(['status' => true]);
    }
}
