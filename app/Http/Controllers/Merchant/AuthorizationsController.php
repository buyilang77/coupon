<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\AuthorizationRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends Controller
{
    /**
     * @param AuthorizationRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function store(AuthorizationRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException(trans('auth.failed'));
        }
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function update()
    {
        $token = Auth::refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('merchant')->logout();
        return response(null, 204);
    }
}
