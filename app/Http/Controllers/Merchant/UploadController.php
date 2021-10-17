<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\UploadRequest;
use App\Imports\CouponItemImport;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class UploadController extends MainController
{
    /**
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function store(UploadRequest $request): JsonResponse
    {
        $date = date('Y-m-d');
        $image = $request->file('file')->store('public/merchant/merchant_' . auth()->id() . '/' . $date);
        return custom_response(['path' => config('domain.merchant-api') . Storage::url($image)]);
    }

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
