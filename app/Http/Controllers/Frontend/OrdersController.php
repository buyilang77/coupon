<?php

namespace App\Http\Controllers\Frontend;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Http\Controllers\MainController;
use App\Http\Requests\Frontend\OrderRequest;
use App\Models\CouponItem;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends MainController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     * @throws ClientException
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
        if ($item->open_status === CouponItem::STATUS_DISABLE) {
            return custom_response(null, '109')->setStatusCode(403);
        }
        if ($item->redemption_status === CouponItem::STATUS_ACTIVATED) {
            return custom_response(null, '110')->setStatusCode(403);
        }
        $data['merchant_id'] = $item->coupon->merchant->id;
        $data['coupon_id'] = $item->coupon_id;
        $order = Order::create($data);

        $item->redemption_status = CouponItem::STATUS_ACTIVATED;
        $item->update();
        $templateParam = [
            'code' => $order->code,
        ];
        $result = $this->sms($order->phone, 'SMS_208626496', $templateParam);
        if (!$result) {
            return custom_response(null, '113');
        }
        return custom_response(null, '108');
    }
}
