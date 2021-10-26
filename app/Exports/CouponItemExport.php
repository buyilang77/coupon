<?php

namespace App\Exports;

use App\Http\Resources\Merchant\CouponItemExportResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CouponItemExport implements FromCollection
{
    public function __construct(public Coupon $coupon)
    {
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $item = CouponItem::where('coupon_id', $this->coupon->id)->get();
        $itemResource = CouponItemExportResource::collection($item)->response()->getData();
        $header = [
            '兑换码',
            '密码',
            '领取链接',
            '开启状态',
            '兑换状态',
        ];
        return new Collection(array_merge([$header], $itemResource->data));
    }
}
