<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\MainController;
use App\Http\Resources\Shop\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponsController extends MainController
{
    public function index(): JsonResponse
    {
        $coupon = Coupon::orderByDesc('id')->paginate($this->perPage);
        return custom_response(CouponResource::collection($coupon)->response()->getData());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
