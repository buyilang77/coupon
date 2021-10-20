<?php

namespace App\Imports;

use App\Models\Coupon;
use App\Models\CouponItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CouponItemImport implements ToCollection
{

    public function __construct(public Coupon $coupon)
    {

    }

    public function collection(Collection $collection)
    {
        unset($collection[0]);
        foreach ($collection as $row) {
            CouponItem::create([
                'code'        => $row[0],
                'coupon_id'   => $this->coupon->id,
                'password'    => $row[1],
                'open_status' => 1,
            ]);
        }
    }
}
