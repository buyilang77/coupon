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
    public function check(Request $request): JsonResponse
    {
        $data = $request->validate(
            [
                'code' => 'required',
                'password' => 'required'
            ],
        );
        $item = RechargeCardItem::where($data)->first();
        if (!$item instanceof RechargeCardItem) {
            return custom_response(null, '107')->setStatusCode(403);
        }
        return custom_response($item);
    }
}
