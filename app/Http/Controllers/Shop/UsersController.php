<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\MainController;
use Illuminate\Http\JsonResponse;

class UsersController extends MainController
{

    /**
     * @return JsonResponse
     */
    public function mine(): JsonResponse
    {
        $user = \Auth::user();
        return custom_response($user);
    }
}
