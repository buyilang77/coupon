<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\OrderRequest;
use App\Models\CouponItem;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $condition = [
            'code'     => $data['code'],
            'password' => $data['password'],
        ];
        $item = CouponItem::where($condition)->first();
        unset($data['password']);
        if (!$item instanceof CouponItem) {
            return custom_response(null, '107')->setStatusCode(403);
        }
        $data['merchant_id'] = $item->coupon->merchant->id;
        $data['coupon_id'] = $item->coupon_id;
        Order::create($data);
        $item->status = CouponItem::STATUS_ACTIVATED;
        $item->update();
        return custom_response(null, '108');
    }
}
