<?php

namespace App\Http\Controllers\RechargeCard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RechargeCardItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function check(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate(
            [
                'code' => 'required|string',
                'password' => 'required|string'
            ],
        );
        $item = RechargeCardItem::where($data)
            ->join('recharge_cards', 'recharge_cards.id', '=', 'recharge_card_items.recharge_card_id')
            ->where('recharge_cards.merchant_id', $product->merchant_id)
            ->first();
        if (!$item instanceof RechargeCardItem) {
            return custom_response(null, '107')->setStatusCode(403);
        }
        return custom_response($item);
    }
}
