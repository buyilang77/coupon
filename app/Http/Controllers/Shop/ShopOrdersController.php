<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\Shop\ShopOrderRequest;
use App\Http\Resources\Shop\OrderResource;
use App\Models\Coupon;
use App\Models\ShopOrderItem;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            'payment_status' => 0,
            'redemption_status' => 0,
        ];
        $couponItems = $coupon->item()->where($condition)->limit($data['amount'])->get(['id']);
        DB::beginTransaction();
        try {
            $order = $this->user()->order()->create($data);
            foreach ($couponItems as  $couponItem) {
                ShopOrderItem::create([
                    'shop_order_id' => $order->id,
                    'coupon_item_id' => $couponItem->id,
                    'status' => 1,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
