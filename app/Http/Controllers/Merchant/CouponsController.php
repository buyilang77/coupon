<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\CouponRequest;
use App\Http\Resources\Merchant\CouponResource;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use DB;
use Log;
use Str;
use Spatie\QueryBuilder\QueryBuilder;

class CouponsController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $coupon = QueryBuilder::for($this->user()->coupon())->orderByDesc('id')->allowedFilters([
            'id', 'type', 'title',
        ])->paginate($this->perPage);
        return custom_response(CouponResource::collection($coupon)->response()->getData());
    }

    /**
     * @param CouponRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(CouponRequest $request): JsonResponse
    {
        if ($this->user()->status !== Merchant::STATUS_ENABLE) {
            return custom_response(null, '112')->setStatusCode(403);
        }
        $coupon = $request->validated();
        unset($coupon['status']);
        DB::beginTransaction();
        try {
            $this->user()->coupon()->create($coupon);
            DB::commit();
            return custom_response(null, '101');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '102')->setStatusCode(403);
    }

    /**
     * Display the specified resource.
     *
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function show(Coupon $coupon): JsonResponse
    {
        return custom_response(CouponResource::make($coupon));
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(CouponRequest $request, Coupon $coupon): JsonResponse
    {
        $data = $request->validated();
        $status = $data['status'];
        unset($data['status']);

        $coupon->prefix = $data['prefix'];
        $coupon->quantity = $data['quantity'];
        $coupon->start_number = $data['start_number'];
        $coupon->length = $data['length'];
        DB::beginTransaction();
        try {
            $coupon->update($data);
            $coupon_item = $this->generateCoupon(
                $coupon->id,
                $data['prefix'],
                $data['quantity'],
                $data['start_number'],
                $data['length'],
                $status
            );
            CouponItem::insert($coupon_item);
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
     * @param string|null $prefix
     * @param int $quantity
     * @param int $start_number
     * @param int $length
     * @param int $status
     * @param bool $is_create
     * @return array
     */
    public function generateCoupon(
        int $coupon_id,
        ?string $prefix,
        int $quantity,
        int $start_number,
        int $length,
        int $status,
        bool $is_create = true
    ): array
    {
        $coupon = [];
        for ($i = $start_number; $i < $start_number + $quantity; $i++) {
            $coupon[$i]['code'] = $prefix . Str::padLeft($i, $length, 0);
            $coupon[$i]['coupon_id'] = $coupon_id;
            $coupon[$i]['open_status'] = $status;
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
    public function destroy(Coupon $coupon): JsonResponse
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
