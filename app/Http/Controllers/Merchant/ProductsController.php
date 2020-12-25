<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\ProductRequest;
use App\Http\Resources\Merchant\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = QueryBuilder::for($this->user()->product())
            ->orderByDesc('id')
            ->allowedFilters(['title'])
            ->paginate($this->perPage);
        return custom_response($data);
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->user()->product()->create($data);
        return custom_response(null, '101');
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $product->update($data);
        return custom_response(null, '103');
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return custom_response(ProductResource::make($product));
    }

    /**
     * @param Product $product
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return custom_response(null)->setStatusCode(204);
    }
}
