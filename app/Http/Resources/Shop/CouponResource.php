<?php

namespace App\Http\Resources\Shop;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;

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
        $condition = [
            'redemption_status' => 0,
            'payment_status' => 0,
        ];
        return [
            'id'                   => $this->resource->id,
            'title'                => $this->resource->title,
            'price'                => sprintf("%.2f", $this->resource->price),
            'services_phone'       => $this->resource->services_phone,
            'activity_description' => Str::limit($this->resource->activity_description, 45, '...'),
            'products'             => Product::whereIn('id', $this->resource->products)->get(['id', 'name', 'price', 'carousel', 'description']),
            'start_time'           => $this->resource->start_time,
            'end_time'             => $this->resource->end_time,
            'stock'                => $this->resource->item()->where($condition)->count(),
        ];
    }
}
