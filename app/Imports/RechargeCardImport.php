<?php

namespace App\Imports;

use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\RechargeCard;
use App\Models\RechargeCardItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RechargeCardImport implements ToCollection
{

    public function __construct(public RechargeCard $card)
    {

    }

    public function collection(Collection $collection)
    {
        unset($collection[0]);
        foreach ($collection as $row) {
            RechargeCardItem::create([
                'code'             => $row[0],
                'recharge_card_id' => $this->card->id,
                'password'         => $row[1],
                'balance'          => $row[2],
                'open_status'      => 1,
            ]);
        }
    }
}
