<?php

namespace App\Http\Resources\Merchant;

use App\Models\CouponItem;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $qr_code_link = config('domain.front-end-h5') . '/#/coupons/' . $this->resource->id;
        return [
            'id'                   => $this->resource->id,
            'qr_code_link'         => $qr_code_link,
            'price'                => $this->resource->price,
            'original_price'       => $this->resource->original_price,
            'title'                => $this->resource->title,
            'services_phone'       => $this->resource->services_phone,
            'activity_description' => $this->resource->activity_description,
            'products'             => $this->resource->products,
            'start_time'           => $this->resource->start_time,
            'end_time'             => $this->resource->end_time,
            'status'               => $this->resource->status,
            'created_at'           => $this->resource->created_at->toDateTimeString(),
        ];
    }
}
