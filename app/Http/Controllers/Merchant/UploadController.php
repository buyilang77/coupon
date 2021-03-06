<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\UploadRequest;
use Illuminate\Http\JsonResponse;
use Storage;

class UploadController extends MainController
{
    /**
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function store(UploadRequest $request): JsonResponse
    {
        $date = date('Y-m-d');
        $image = $request->file('file')->store('public/merchant/merchant_' . auth()->id() . '/' . $date);
        return custom_response(['path' => config('domain.merchant-api') . Storage::url($image)]);
    }
}
