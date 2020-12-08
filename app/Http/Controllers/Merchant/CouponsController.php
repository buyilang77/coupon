<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\CouponRequest;
use App\Http\Resources\Merchant\CouponResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use Illuminate\Http\JsonResponse;
use Request;
use DB;
use Log;
use Str;
use Spatie\QueryBuilder\QueryBuilder;

class CouponsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $coupon = QueryBuilder::for(Coupon::class)->orderByDesc('id')->allowedFilters([
            'id', 'status', 'title',
        ])->paginate($this->perPage);
        return custom_response(CouponResource::collection($coupon)->response()->getData());
    }

    /**
     * @param CouponRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(CouponRequest $request)
    {
        $coupon = $request->validated();
        DB::beginTransaction();
        try {
            $coupon_result = $this->user()->coupon()->create($coupon);
            $coupon_item = $this->generateCoupon(
                $coupon_result->id,
                $coupon['prefix'],
                $coupon['quantity'],
                $coupon['start_number'],
                $coupon['length'],
                );
            CouponItem::insert($coupon_item);
            DB::commit();
            return custom_response(null, '101');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '102')->setStatusCode(403);
    }

    /**
     * @param CouponRequest $request
     * @param int $coupon
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(CouponRequest $request, int $coupon)
    {
        $data = $request->validated();

        $coupon = Coupon::find($coupon);
        $coupon->prefix = $data['prefix'];
        $coupon->quantity = $data['quantity'];
        $coupon->start_number = $data['start_number'];
        $coupon->length = $data['length'];
        $coupon_items_id = $coupon->item->pluck('id')->all();
        $cases = [];
        DB::beginTransaction();
        try {
            $coupon->update($data);
            $coupon_item = $this->generateCoupon(
                $coupon->id,
                $coupon->prefix,
                $coupon->quantity,
                $coupon->start_number,
                $coupon->length,
                false
            );
            foreach ($coupon_items_id as $key => $item) {
                $cases[] = "WHEN `id` = {$item} THEN '{$coupon_item[$key]['code']}'";
            }
            $cases = implode(' ', $cases);
            $coupon_items_id = implode(',', $coupon_items_id);
            DB::update("UPDATE `coupon_items` SET `code` = (CASE {$cases} END) WHERE `id` IN ({$coupon_items_id})");
            DB::commit();
            return custom_response(null, '103');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '104')->setStatusCode(403);
    }

    /**
     * Generate coupon list.
     * @param int $coupon_id
     * @param string $prefix
     * @param int $quantity
     * @param int $start_number
     * @param int $length
     * @param bool $is_create
     * @return array
     */
    public function generateCoupon(
        int $coupon_id,
        string $prefix,
        int $quantity,
        int $start_number,
        int $length,
        bool $is_create = true
    ): array
    {
        $coupon = [];
        for ($i = $start_number; $i < $start_number + $quantity; $i++) {
            $coupon[$i]['code'] = $prefix . Str::padLeft($i, $length, 0);
            $coupon[$i]['coupon_id'] = $coupon_id;
            if ($is_create) {
                $coupon[$i]['password'] = Str::padLeft(mt_rand(000000, 999999), 6, 0);
            }
        }
        return array_values($coupon);
    }

    /**
     * @param Coupon $coupon
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Coupon $coupon)
    {
        DB::beginTransaction();
        try {
            $coupon->item()->delete();
            $coupon->delete();
            DB::commit();
            return custom_response(null)->setStatusCode(204);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '105')->setStatusCode(403);
    }
}
