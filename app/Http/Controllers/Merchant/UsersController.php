<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\MainController;
use App\Http\Requests\Merchant\UserRequest;
use App\Models\Merchant;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController
 * @package App\Http\Controllers\Merchant
 */
class UsersController extends MainController
{

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $item = $request->validated();
        $item['password'] = bcrypt($item['password']);
        $user = new Merchant($item);
        $user->save();
        return $this->respondWithToken(Auth::login($user))->setStatusCode(201);
    }

    /**
     * @return JsonResponse
     */
    public function mine(): JsonResponse
    {
        $user = $this->user();
        return custom_response($user);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $password = $data['password'] ?? null;
        if ($password) {
            $data['password'] = Hash::make($password);
        }
        $this->user()->update($data);
        return custom_response(null, '103');
    }
}
