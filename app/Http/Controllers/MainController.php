<?php

namespace App\Http\Controllers;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Models\Admin;
use App\Models\Merchant;
use App\Models\ShopUser;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class MainController extends Controller
{
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
     * @return Merchant|Admin|ShopUser|Authenticatable
     */
    public function user(): Merchant|Admin|ShopUser|Authenticatable
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
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
        ]);
    }

    /**
     * @param string $phone
     * @param string $templateCode
     * @param array $templateParam
     * @return bool
     * @throws ClientException
     */
    public function sms(string $phone, string $templateCode, array $templateParam): bool
    {
        AlibabaCloud::accessKeyClient(env('ALiYun_SMS_AccessKeyId'), env('ALiYun_SMS_AccessKeySecret'))
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId'      => "cn-hangzhou",
                        'PhoneNumbers'  => $phone,
                        'SignName'      => "蜗牛网络",
                        'TemplateCode'  => $templateCode,
                        'TemplateParam' => json_encode($templateParam),
                    ],
                ])
                ->request();
            return true;
        } catch (ClientException | ServerException $e) {
            Log::error($e->getErrorMessage());
        }
        return false;
    }
}
