<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\ElectronicCardTemplateRequest;
use App\Models\ElectronicCardTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ElectronicCardTemplateController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $item = QueryBuilder::for($this->user()->electronicCardTemplate())->orderByDesc('id')->paginate($this->perPage);
        return custom_response($item);
    }

    /**
     * @param ElectronicCardTemplateRequest $request
     * @return JsonResponse
     */
    public function store(ElectronicCardTemplateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->user()->electronicCardTemplate()->create($data);
        return custom_response(null, '101');
    }

    /**
     * @param ElectronicCardTemplateRequest $request
     * @param ElectronicCardTemplate $electronicCardTemplate
     * @return JsonResponse
     */
    public function update(ElectronicCardTemplateRequest $request, ElectronicCardTemplate $electronicCardTemplate): JsonResponse
    {
        $data = $request->validated();
        $electronicCardTemplate->update($data);
        return custom_response(null, '103');
    }

    /**
     * @param ElectronicCardTemplate $electronicCardTemplate
     * @return JsonResponse
     */
    public function show(ElectronicCardTemplate $electronicCardTemplate): JsonResponse
    {
        return custom_response($electronicCardTemplate);
    }

    /**
     * @param ElectronicCardTemplate $electronicCardTemplate
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(ElectronicCardTemplate $electronicCardTemplate): JsonResponse
    {
        $electronicCardTemplate->delete();
        return custom_response(null)->setStatusCode(204);
    }
}
