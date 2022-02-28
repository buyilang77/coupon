<?php

namespace App\Imports;

use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\LogisticsCompany;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\RechargeCard;
use App\Models\RechargeCardItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LogisticsImport implements ToCollection
{

    public function __construct(public Merchant $merchant)
    {

    }

    public function collection(Collection $collection)
    {
        unset($collection[0]);
        foreach ($collection as $row) {
            if ($row[3] && $row[4])
            Order::find($row[0])->update([
                'logistics_company_id' => $row[3],
                'tracking_number'      => $row[4],
                'status'               => 1,
            ]);
        }
    }
}
