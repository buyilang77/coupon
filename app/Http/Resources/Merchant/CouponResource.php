<?php

namespace App\Http\Resources\Merchant;

use App\Models\CouponItem;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->resource->id,
            'products'     => $this->resource->products,
            'title'        => $this->resource->title,
            'start_time'   => $this->resource->start_time,
            'end_time'     => $this->resource->end_time,
            'prefix'       => $this->resource->prefix,
            'start_number' => $this->resource->start_number,
            'quantity'     => $this->resource->quantity,
            'usage_amount' => $this->resource->item->where('status', CouponItem::STATUS_ACTIVATED)->count(),
            'length'       => $this->resource->length,
            'status'       => $this->resource->status,
            'created_at'   => $this->resource->created_at->toDateTimeString(),
        ];
    }
}
