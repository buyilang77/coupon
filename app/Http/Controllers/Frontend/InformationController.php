<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\MainController;
use App\Models\Coupon;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class InformationController extends MainController
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

    /**
     * @param string $username
     * @return JsonResponse
     */
    public function index(string $username): JsonResponse
    {
        $merchant = Merchant::where('username', $username)->first();
        return custom_response($merchant);
    }
}
