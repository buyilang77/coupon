<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Resources\Merchant\CouponItemResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\RechargeCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CouponsItemsController extends MainController
{
    /**
     * @param Coupon $coupon
     * @return AnonymousResourceCollection
     */
    public function index(Coupon $coupon): AnonymousResourceCollection
    {
        $coupon = QueryBuilder::for($coupon->item())->orderByDesc('id')->allowedFilters([
            'open_status', 'redemption_status', 'code',
        ])->with('coupon')->select([
            'id', 'coupon_id', 'code', 'open_status', 'redemption_status', 'password'
        ])->paginate($this->perPage);
        return CouponItemResource::collection($coupon);
    }

    /**
     * @param Request $request
     * @param CouponItem $item
     * @return JsonResponse
     */
    public function update(Request $request, CouponItem $item): JsonResponse
    {
        $data = $request->validate([
            'open_status'                 => 'nullable|in:0,1',
            'electronic_card_template_id' => 'nullable|integer'
        ]);
        $item->update($data);
        return custom_response(null, '103');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkUpdate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'items'       => 'required|array',
            'open_status' => 'required|in:0,1'
        ]);
        CouponItem::whereIn('id', $data['items'])->update(['open_status' => $data['open_status']]);
        return custom_response(null, '103');
    }

}
