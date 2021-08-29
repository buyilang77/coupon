<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\MainController;
use App\Http\Resources\Shop\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponsController extends MainController
{
    public function index(): JsonResponse
    {
        $coupon = Coupon::orderByDesc('id')->paginate(50);
        return custom_response(CouponResource::collection($coupon)->response()->getData());
    }

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
}
