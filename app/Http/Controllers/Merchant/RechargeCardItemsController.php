<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\RechargeCardItemRequest;
use App\Http\Resources\Merchant\RechargeCardItemResource;
use App\Models\RechargeCardItem;
use App\Models\RechargeCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;
use Str;

class RechargeCardItemsController extends MainController
{
    /**
     * @param RechargeCard $item
     * @return AnonymousResourceCollection
     */
    public function index(RechargeCard $item): AnonymousResourceCollection
    {
        $item = QueryBuilder::for($item->item())->orderByDesc('id')->allowedFilters([
            'open_status', 'code',
        ])->with('rechargeCard')->paginate($this->perPage);
        return RechargeCardItemResource::collection($item);
    }

    /**
     * @param RechargeCardItemRequest $request
     * @param RechargeCard $item
     * @return JsonResponse
     */
    public function store(RechargeCardItemRequest $request, RechargeCard $item): JsonResponse
    {
        $data = $request->validated();
        $data['recharge_card_id'] = $item->id;
        $data['balance'] = $item->denomination;
        $coupon_item = $this->generateCoupon($data);
        RechargeCardItem::insert($coupon_item);
        return custom_response(null, '103');
    }

    /**
     * @param Request $request
     * @param RechargeCardItem $item
     * @return JsonResponse
     */
    public function update(Request $request, RechargeCardItem $item): JsonResponse
    {
        $data = $request->validate(['open_status' => 'required|in:0,1']);
        $item->update(['open_status' => $data['open_status']]);
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
        RechargeCardItem::whereIn('id', $data['items'])->update(['open_status' => $data['open_status']]);
        return custom_response(null, '103');
    }

    /**
     * @param array $data
     * @return array
     */
    public function generateCoupon(array $data): array
    {
        $coupon = [];
        for ($i = $data['start_number']; $i < $data['start_number'] + $data['quantity']; $i++) {
            $coupon[$i]['balance'] = $data['balance'];
            $coupon[$i]['code'] = $data['prefix'] . Str::padLeft($i, $data['length'], 0);
            $coupon[$i]['recharge_card_id'] = $data['recharge_card_id'];
            $coupon[$i]['open_status'] = $data['status'];
            $coupon[$i]['password'] = Str::padLeft(mt_rand(000000, 999999), 6, 0);
        }
        return array_values($coupon);
    }

}
