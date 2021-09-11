<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\MainController;
use App\Http\Requests\Shop\PickupOrderRequest;
use App\Http\Requests\Shop\ShopOrderRequest;
use App\Http\Resources\Shop\OrderResource;
use App\Http\Resources\Shop\ReceivedOrderResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\Order;
use App\Models\ShopOrder;
use App\Models\ShopOrderItem;
use DB;
use Illuminate\Http\JsonResponse;

class ShopOrdersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $order = $this->user()->order->sortByDesc('id');
        return custom_response(OrderResource::collection($order));
    }

    /**
     * @param ShopOrderRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(ShopOrderRequest $request): JsonResponse
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
        try {
            $order = $this->user()->order()->create($data);
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
            \Log::error($e);
            DB::rollBack();
        }
        return custom_response([], '114');
    }

    /**
     * @param PickupOrderRequest $request
     * @param ShopOrder $order
     * @return JsonResponse
     * @throws \Throwable
     */
    public function pickup(PickupOrderRequest $request, ShopOrder $order): JsonResponse
    {
        $data = $request->validated();
        $shopOrderItems = $order->item()->where('status', 1)->limit($data['amount'])->get();
        $couponItemIds = $shopOrderItems->pluck('coupon_item_id');
        $couponItems = CouponItem::whereIn('id', $couponItemIds)->where('redemption_status', 0)->get();
        if ($couponItems->isEmpty()) {
            return custom_response(null)->setStatusCode(403);
        }
        $data['merchant_id'] = $order->coupon->merchant->id;
        $data['product_id'] = $order->coupon->products[0];
        $data['coupon_id'] = $order->coupon_id;
        $data['code'] = $couponItems->pluck('code');
        $data['shop_user_id'] = $this->user()->id;
        unset($data['amount']);
        unset($data['order_id']);
        DB::beginTransaction();
        try {
            Order::create($data);
            foreach ($couponItems as $couponItem) {
                $couponItem->redemption_status = 1;
                $couponItem->update();

                ShopOrderItem::where([
                    'status'         => 1,
                    'shop_order_id'  => $order->id,
                    'coupon_item_id' => $couponItem->id,
                ])->update(['status' => 2]);
            }
            DB::commit();
        } catch (\Throwable $exception) {
            \Log::error($exception->getMessage());
            DB::rollBack();
        }
        return custom_response(null, '108');
    }

    /**
     * Display the specified resource.
     *
     * @param ShopOrder $order
     * @return JsonResponse
     */
    public function show(ShopOrder $order): JsonResponse
    {
        return custom_response(OrderResource::make($order));
    }

    /**
     * @return JsonResponse
     */
    public function received(): JsonResponse
    {
        return custom_response(ReceivedOrderResource::collection($this->user()->receivedOrder));
    }

    /**
     * @return JsonResponse
     */
    public function receivedDetail(Order $order): JsonResponse
    {
        return custom_response(ReceivedOrderResource::make($order));
    }
}
