<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\StoreRequest;
use App\Http\Resources\Merchant\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class StoresController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = QueryBuilder::for($this->user()->store())
            ->orderByDesc('id')
            ->allowedFilters(['title'])
            ->paginate($this->perPage);
        return custom_response($data);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->user()->store()->create($data);
        return custom_response(null, '101');
    }

    /**
     * @param Store $store
     * @return JsonResponse
     */
    public function show(Store $store): JsonResponse
    {
        return custom_response($store);
    }

    /**
     * @param StoreRequest $request
     * @param Store $store
     * @return JsonResponse
     */
    public function update(StoreRequest $request, Store $store): JsonResponse
    {
        $data = $request->validated();
        $store->update($data);
        return custom_response(null, '103');
    }

    /**
     * @param Store $store
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Store $store): JsonResponse
    {
        $store->delete();
        return custom_response(null)->setStatusCode(204);
    }
}
