<?php

namespace App\Http\Resources\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->resource->title,
            'products' => Product::whereIn('id', $this->resource->products)->get(['id', 'name', 'price', 'carousel', 'description']),
            'total_shipments' => $this->resource->order->count(),
        ];
    }
}
