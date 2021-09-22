<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\ActivitiesRequest;
use App\Http\Requests\Merchant\CouponRequest;
use App\Http\Resources\Merchant\ActivityResource;
use App\Http\Resources\Merchant\CouponResource;
use App\Models\Activity;
use App\Models\Coupon;
use App\Models\CouponItem;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use DB;
use Log;
use Str;
use Spatie\QueryBuilder\QueryBuilder;

class ActivitiesController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $activity = QueryBuilder::for(Coupon::class)->orderByDesc('id')->allowedFilters([
            'id', 'status', 'title',
        ])->paginate($this->perPage);
        return custom_response(ActivityResource::collection($activity)->response()->getData());
    }

    /**
     * @param ActivitiesRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(ActivitiesRequest $request): JsonResponse
    {
        if ($this->user()->status !== Merchant::STATUS_ENABLE) {
            return custom_response(null, '112')->setStatusCode(403);
        }
        $activity = $request->validated();
        $this->user()->coupon()->create($activity);
        return custom_response(null, '101');
    }

    /**
     * Display the specified resource.
     *
     * @param Coupon $activity
     * @return JsonResponse
     */
    public function show(Coupon $activity): JsonResponse
    {
        return custom_response(ActivityResource::make($activity));
    }

    /**
     * @param ActivitiesRequest $request
     * @param Coupon $activity
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(ActivitiesRequest $request, Coupon $activity): JsonResponse
    {
        $data = $request->validated();

        $activity->update($data);
        return custom_response(null, '103');

    }

    /**
     * @param Coupon $activity
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Coupon $activity): JsonResponse
    {
        DB::beginTransaction();
        try {
            $activity->delete();
            DB::commit();
            return custom_response(null)->setStatusCode(204);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '105')->setStatusCode(403);
    }
}
