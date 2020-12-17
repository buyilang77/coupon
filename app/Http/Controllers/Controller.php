<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var int $perPage Per Page.
     */
    public $perPage;

    /**
     * @var string $guard
     */
    public $guard;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->guard = $request->get('guard');
        Auth()->shouldUse($this->guard);
        $this->perPage = $request->limit ?? 15;
    }

    /**
     * @return Authenticatable|Merchant
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
