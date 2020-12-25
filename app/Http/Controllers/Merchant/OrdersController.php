<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\OrderRequest;
use App\Http\Requests\Merchant\OrderShipmentRequest;
use App\Http\Resources\Merchant\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OrdersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = QueryBuilder::for($this->user()->order())
            ->orderByDesc('id')
            ->allowedFilters(['title', 'status'])
            ->paginate($this->perPage);
        return custom_response(OrderResource::collection($orders)->response()->getData());
    }

    /**
     * Update Order consignee information.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        $data = $request->validated();
        $order->update($data);
        return custom_response(null, '103');
    }

    /**
     * Order shipment.
     *
     * @param OrderShipmentRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function ship(OrderShipmentRequest $request, Order $order): JsonResponse
    {
        $data = $request->validated();
        $order->update($data);
        return custom_response(null, '106');
    }
}
