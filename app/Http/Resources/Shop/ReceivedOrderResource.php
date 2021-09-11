<?php

namespace App\Http\Resources\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $status = match ($this->resource->status) {
            0 => '待发货',
            1 => '配送中',
            2 => '收到订单',
        };
        return [
            'id'                => $this->resource->id,
            'logistics_company' => $this->resource->logisticsCompany?->name,
            'tracking_number'   => $this->resource->tracking_number,
            'code'              => $this->resource->code,
            'title'             => $this->resource->coupon->title,
            'product'           => $this->resource->product,
            'consignee'         => $this->resource->consignee,
            'phone'             => $this->resource->phone,
            'region'            => $this->resource->region,
            'address'           => $this->resource->address,
            'status'            => $status,
            'created_at'        => $this->resource->created_at->toDateTimeString(),
        ];
    }
}
