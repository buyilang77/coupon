<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function show(Request $request, Coupon $coupon): JsonResponse
    {
        return custom_response(CouponResource::make($coupon));
    }
}
