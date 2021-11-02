<?php

namespace App\Http\Resources\Frontend;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                   => $this->resource->id,
            'title'                => $this->resource->title,
            'merchant'             => $this->resource->merchant,
            'services_phone'       => $this->resource->services_phone,
            'activity_description' => $this->resource->activity_description,
            'start_time'           => $this->resource->start_time,
            'end_time'             => $this->resource->end_time,
            'products'             => Product::whereIn('id', $this->resource->products)->get(['id', 'name', 'price', 'carousel', 'description']),
            'total_shipments'      => $this->resource->order->count(),
        ];
    }
}
