<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponItem;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckController extends Controller
{

    /**
     * @param Request $request
     * @param Merchant $merchant
     * @return JsonResponse
     */
    public function check(Request $request, Merchant $merchant): JsonResponse
    {
        $data = $request->validate(
            [
                'code'     => 'required|string',
                'password' => 'required|string'
            ],
        );
        $item = CouponItem::whereRaw("BINARY `code`= ?", [$data['code']])
            ->whereRaw("BINARY `password`= ?", [$data['password']])
            ->join('coupons', 'coupons.id', '=', 'coupon_items.coupon_id')
            ->where('coupons.merchant_id', $merchant->id)
            ->first()?->load('electronicCard');
        if (!$item instanceof CouponItem) {
            return custom_response(null, '107')->setStatusCode(403);
        }
        return custom_response($item);
    }
}
