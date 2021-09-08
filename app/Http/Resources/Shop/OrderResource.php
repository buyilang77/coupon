<?php

namespace App\Http\Resources\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $type_text = match ($this->resource->type) {
            1 => '购买',
            2 => '受赠',
        };
        return [
            'id'         => $this->resource->id,
            'type'       => $type_text,
            'amount'     => $this->resource->amount,
            'coupon'     => $this->resource->coupon,
            'products'   => Product::whereIn('id', $this->resource->coupon->products)->get(['id', 'carousel']),
            'status'     => (int)$this->resource->status,
            'stock'      => $this->resource->item->count(),
            'created_at' => $this->resource->created_at->toDateString(),
        ];
    }
}
