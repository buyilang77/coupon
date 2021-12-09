<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class RechargeCardResource extends JsonResource
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
            'name'                 => $this->resource->name,
            'price'                => $this->resource->price,
            'denomination'         => $this->resource->denomination,
            'type'                 => $this->resource->type,
            'is_online'            => $this->resource->is_online,
            'carousel'             => $this->resource->carousel ?? [],
            'remark'               => $this->resource->remark,
            'activity_description' => $this->resource->activity_description,
        ];
    }
}
