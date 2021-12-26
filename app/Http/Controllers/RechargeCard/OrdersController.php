<?php

namespace App\Http\Controllers\RechargeCard;

use App\Http\Controllers\MainController;
use App\Http\Requests\RechargeCard\OrderRequest;
use App\Models\Product;
use App\Models\RechargeCardItem;
use App\Models\RechargeCardOrder;
use DB;
use Illuminate\Http\JsonResponse;

class OrdersController extends MainController
{

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $condition = \Arr::only($data, ['code', 'password']);
        $card = RechargeCardItem::where($condition)->first();
        $product = Product::find($data['product_id']);
        $price = (float) $product->price;
        $amount = $data['amount'];

        $total_amount = $amount * $price;
        if ($amount > intval($card->balance / $price)) {
            return custom_response([], '116')->setStatusCode(403);
        }
        $data['total_amount'] = $data['amount'] * $price;
        $data['merchant_id'] = $product->merchant_id;
        $data['recharge_card_item_id'] = $card->id;
        unset($data['code']);
        unset($data['password']);
        DB::beginTransaction();
        try {
            $card->balance = $card->balance - $total_amount;
            $card->save();
            RechargeCardOrder::create($data);
            DB::commit();
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
        }
        return custom_response([], '114');
    }
}
