<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponItemResource extends JsonResource
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
            'id'                     => $this->resource->id,
            'qr_code_link'           => config('domain.h5') . '/#/coupons/' . $this->resource->coupon->id,
            'code'                   => $this->resource->code,
            'password'               => $this->resource->password,
            'open_status'            => $this->resource->open_status,
            'open_status_text'       => $this->resource->open_status_text,
            'redemption_status'      => $this->resource->redemption_status,
            'redemption_status_text' => $this->resource->redemption_status_text,
        ];
    }
}
