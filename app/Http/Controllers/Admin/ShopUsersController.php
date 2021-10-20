<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\UserRequest;
use App\Models\Merchant;
use App\Models\ShopUser;
use Auth;
use Illuminate\Http\JsonResponse;

/**
 * Class ShopUsersController
 * @package App\Http\Controllers\Merchant
 */
class ShopUsersController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function users(): JsonResponse
    {
        $user = ShopUser::orderByDesc('id')->paginate($this->perPage);
        return custom_response($user);
    }
}
