<?php

namespace App\Http\Controllers\Merchant;

use App\Exports\CouponItemExport;
use App\Exports\CouponItemTemplateExport;
use App\Exports\RechargeCardExport;
use App\Exports\RechargeCardTemplateExport;
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
     * @return BinaryFileResponse
     */
    public function couponItemTemplate(): BinaryFileResponse
    {
        return Excel::download(new CouponItemTemplateExport(), 'CouponItemTemplate.xlsx');
    }

    /**
     * @param RechargeCard $item
     * @return BinaryFileResponse
     */
    public function rechargeCardItem(RechargeCard $item): BinaryFileResponse
    {
        return Excel::download(new RechargeCardExport($item), 'RechargeCard.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function rechargeCardTemplate(): BinaryFileResponse
    {
        return Excel::download(new RechargeCardTemplateExport(), 'RechargeCardTemplate.xlsx');
    }
}
