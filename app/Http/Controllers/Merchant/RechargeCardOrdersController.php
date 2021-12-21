<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\RechargeCardOrderRequest;
use App\Models\RechargeCardOrder;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeCardOrdersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = QueryBuilder::for($this->user()->rechargeCardOrder())
            ->orderByDesc('id')
            ->allowedFilters(['title', 'status'])
            ->paginate($this->perPage);
        return custom_response($orders);
    }

    /**
     * Order shipment.
     *
     * @param RechargeCardOrderRequest $request
     * @param RechargeCardOrder $order
     * @return JsonResponse
     */
    public function writeOff(RechargeCardOrderRequest $request, RechargeCardOrder $order): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = 1;
        $order->update($data);
        return custom_response(null, '115');
    }
}
