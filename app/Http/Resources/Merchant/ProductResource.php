<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'          => $this->resource->id,
            'name'        => $this->resource->name,
            'price'        => $this->resource->price,
            'carousel'    => $this->resource->carousel,
            'description' => $this->resource->description,
        ];
    }
}
