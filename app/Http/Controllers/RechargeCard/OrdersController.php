<?php

namespace App\Http\Controllers\RechargeCard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = $request->validated();
        $coupon = Coupon::find($data['coupon_id']);
        $data['total_amount'] = $data['amount'] * $coupon->price;
        $data['type'] = 1;
        $condition = [
            'payment_status'    => 0,
            'redemption_status' => 0,
        ];
        $couponItems = $coupon->item()->where($condition)->limit($data['amount'])->get(['id']);
        DB::beginTransaction();
        $order = $this->user()->order()->create($data);
        try {
            foreach ($couponItems as $couponItem) {
                ShopOrderItem::create([
                    'shop_order_id'  => $order->id,
                    'coupon_item_id' => $couponItem->id,
                    'status'         => 1,
                ]);
                $couponItem->payment_status = 1;
                $couponItem->save();
            }
            DB::commit();
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
        }
        $prepay = [
            'out_trade_no' => $order->order_no,
            'description'  => $coupon->title,
            'amount'       => [
                'total' => $data['total_amount'] * 100,
            ],
            'payer'        => [
                'openid' => $this->user()->mp_openid,
            ],
        ];

        $result = Pay::wechat()->mp($prepay);
        return custom_response($result, '114');
    }
}
