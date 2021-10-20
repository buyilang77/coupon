<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\UploadRequest;
use App\Imports\CouponItemImport;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * @param UploadRequest $request
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function couponItem(UploadRequest $request, Coupon $coupon): JsonResponse
    {
        Excel::import(new CouponItemImport($coupon), $request->file('file'));
        return custom_response([])->setStatusCode(201);
    }
}
