<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\RechargeCardRequest;
use App\Http\Resources\Merchant\RechargeCardResource;
use App\Models\RechargeCard;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use DB;
use Log;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeCardController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $coupon = QueryBuilder::for($this->user()->rechargeCard())->orderByDesc('id')->allowedFilters([
            'id', 'type', 'name',
        ])->paginate($this->perPage);
        return custom_response(RechargeCardResource::collection($coupon)->response()->getData());
    }

    /**
     * @param RechargeCardRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(RechargeCardRequest $request): JsonResponse
    {
        if ($this->user()->status !== Merchant::STATUS_ENABLE) {
            return custom_response(null, '112')->setStatusCode(403);
        }
        $coupon = $request->validated();
        DB::beginTransaction();
        try {
            $this->user()->rechargeCard()->create($coupon);
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
     * @param RechargeCard $rechargeCard
     * @return JsonResponse
     */
    public function show(RechargeCard $rechargeCard): JsonResponse
    {
        return custom_response(RechargeCardResource::make($rechargeCard));
    }

    /**
     * @param RechargeCardRequest $request
     * @param RechargeCard $rechargeCard
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(RechargeCardRequest $request, RechargeCard $rechargeCard): JsonResponse
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $rechargeCard->update($data);
            DB::commit();
            return custom_response(null, '103');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '104')->setStatusCode(403);
    }

    /**
     * @param RechargeCard $rechargeCard
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(RechargeCard $rechargeCard): JsonResponse
    {
        DB::beginTransaction();
        try {
            $rechargeCard->item()->delete();
            $rechargeCard->delete();
            DB::commit();
            return custom_response(null)->setStatusCode(204);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        return custom_response(null, '105')->setStatusCode(403);
    }
}
