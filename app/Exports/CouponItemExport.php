<?php

namespace App\Exports;

use App\Models\CouponItem;
use Maatwebsite\Excel\Concerns\FromCollection;

class CouponItemExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CouponItem::all();
    }
}
