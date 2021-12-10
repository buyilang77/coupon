<?php

namespace App\Http\Controllers\Merchant;

use App\Exports\CouponItemExport;
use App\Exports\CouponItemTemplateExport;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\RechargeCard;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * @param Coupon $coupon
     * @return BinaryFileResponse
     */
    public function couponItem(Coupon $coupon): BinaryFileResponse
    {
        return Excel::download(new CouponItemExport($coupon), 'CouponItem.xlsx');
    }

    /**
     * @param Coupon $coupon
     * @return BinaryFileResponse
     */
    public function couponItemTemplate(Coupon $coupon): BinaryFileResponse
    {
        return Excel::download(new CouponItemTemplateExport($coupon), 'CouponItemTemplate.xlsx');
    }

    /**
     * @param RechargeCard $item
     * @return BinaryFileResponse
     */
    public function rechargeCardItem(RechargeCard $item): BinaryFileResponse
    {
        return Excel::download(new CouponItemExport($item), 'CouponItem.xlsx');
    }
}
