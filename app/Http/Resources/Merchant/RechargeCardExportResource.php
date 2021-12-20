<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class RechargeCardExportResource extends JsonResource
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
            'code'             => $this->resource->code,
            'password'         => $this->resource->password,
            'balance'          => $this->resource->balance,
            'qr_code_link'     => 'http://recharge-card.hipi5.com/' . $this->resource->rechargeCard->merchant->username,
            'open_status_text' => $this->resource->open_status_text,
        ];
    }
}
