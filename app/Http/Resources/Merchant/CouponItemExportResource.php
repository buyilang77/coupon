<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponItemExportResource extends JsonResource
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
            'code'                   => $this->resource->code,
            'password'               => $this->resource->password,
            'qr_code_link'           => config('domain.front-end-h5') . '/#/coupons/' . $this->resource->coupon->id,
            'open_status_text'       => $this->resource->open_status_text,
            'redemption_status_text' => $this->resource->redemption_status_text,
        ];
    }
}
