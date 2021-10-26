<?php

namespace App\Http\Controllers\Merchant;

use App\Exports\CouponItemExport;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function couponItem(Coupon $coupon): BinaryFileResponse
    {
        return Excel::download(new CouponItemExport($coupon), 'CouponItem.xlsx');
    }
}
