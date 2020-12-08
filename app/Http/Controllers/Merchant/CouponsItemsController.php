<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\CouponItemRequest;
use App\Http\Requests\Merchant\CouponRequest;
use App\Http\Resources\Merchant\CouponItemResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use DB;
use Illuminate\Http\JsonResponse;
use Log;
use Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CouponsItemsController extends Controller
{
    /**
     * @param Request $request
     * @param Coupon $coupon
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, Coupon $coupon): AnonymousResourceCollection
    {
        $prePage = $request->limit ?? null;
        $coupon = QueryBuilder::for($coupon->item())->orderByDesc('id')->allowedFilters([
            'status', 'code',
        ])->select(['id', 'code', 'status', 'password'])->paginate($prePage);
        return CouponItemResource::collection($coupon);
    }

    /**
     * @param CouponItemRequest $request
     * @param CouponItem $item
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(CouponItemRequest $request)
    {
        $data = $request->validated();
        $type = $data['type'];
        $status = null;
        switch ($data['status']) {
            case CouponItem::STATUS_ENABLE:
                $status = CouponItem::STATUS_ENABLE;
                break;
            case CouponItem::STATUS_DISABLE:
                $status = CouponItem::STATUS_DISABLE;
                break;
        }
        DB::beginTransaction();
        try {
            switch ($type) {
                case CouponItem::TYPE_SINGLE:
                    $item = CouponItem::find($data['item']);
                    $item->update(['status' => $status]);
                    break;
                case CouponItem::TYPE_BATCH:
                    CouponItem::whereIn('id', $data['items'])->update(['status' => $status]);
                    break;
            }
            DB::commit();
            return custom_response(null, '103');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '104')->setStatusCode(403);
    }

}
