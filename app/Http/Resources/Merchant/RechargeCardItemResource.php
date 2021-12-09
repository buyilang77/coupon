<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class RechargeCardItemResource extends JsonResource
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
            'id'          => $this->resource->id,
            'shop_user'   => $this->resource->shopUser,
            'balance'     => $this->resource->balance,
            'code'        => $this->resource->code,
            'password'    => $this->resource->password,
            'open_status' => $this->resource->open_status,
        ];
    }
}
