<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\UserRequest;
use App\Models\Merchant;
use Auth;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController
 * @package App\Http\Controllers\Merchant
 */
class UsersController extends MainController
{
    /**
     * @return JsonResponse
     */
    public function mine(): JsonResponse
    {
        $user = $this->user();
        return custom_response($user);
    }

    public function update(UserRequest $request)
    {
        $attributes = $request->only(['name', 'surname', 'phone', 'sex']);
        $this->user()->update($attributes);
        return custom_response($this->user());
    }
}
