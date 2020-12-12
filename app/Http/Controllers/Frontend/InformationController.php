<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class InformationController extends Controller
{
    /**
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function merchant(Coupon $coupon): JsonResponse
    {
        $merchant = $coupon->merchant()->first(['phone']);
        return custom_response($merchant);
    }
}
