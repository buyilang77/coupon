<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\MainController;
use App\Models\ShopUser;
use Auth;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthorizationsController extends MainController
{
    /**
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function oauth(): RedirectResponse
    {
        $oauth = $this->officialAccount()->getOAuth();
        $redirectUrl = $oauth->scopes(['snsapi_userinfo'])->redirect('http://api.shop.hipi5.com/authorizations/wechat/callback');
        return \redirect($redirectUrl);
    }

    public function callback(Request $request)
    {
        $oauth = $this->officialAccount()->getOAuth();

        $wechatUser = $oauth->userFromCode($request->code);
        $user = ShopUser::where('mp_openid', $wechatUser->getId())->first();

        if (!$user instanceof ShopUser) {

            // If this user does not exist, generate
            $user = ShopUser::create([
                'username' => $wechatUser->getNickname(),
                'avatar' => $wechatUser->getAvatar(),
                'mp_openid' => $wechatUser->getId(),
                'unionid' => $wechatUser->getRaw()['unionid'],
            ]);
        }
        $token = Auth::login($user);
        return redirect('http://shop.hipi5.com:8081/#/user?access_token=' . $token);
    }

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function officialAccount(): Application
    {
        $config = [
            'app_id' => 'wx7607a9c6ed1b94b4',
            'secret' => '562cb8b67b7436cca6518e0a3b5c4c84',
            'token' => 'U31FI0k1Ak0aUKUf3II3T3ofo555IfbZ',
            'aes_key' => 'Niq20113Z2RiKWkqCiuu0xXXxqgskrYX9XKk1Nruwxu',
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/auth_callback_mp'),
            ],
            /**
             * 日志配置 (默认不启用日志)
             *
             * level: 日志级别, 可选为：
             *         debug/info/notice/warning/error/critical/alert/emergency
             * path：日志文件位置(绝对路径!!!)，要求可写权限
             */
            'logging' => [
                'default' => 'dev', // 默认使用的 channel，生产环境可以改为下面的 prod
                'channels' => [
                    // 测试环境
                    'dev' => [
                        'driver' => 'single',
                        'path' => storage_path('logs/easywechat.log'),
                        'level' => 'debug',
                    ],
                    // 生产环境
                    'prod' => [
                        'driver' => 'daily',
                        'path' => storage_path('logs/easywechat.log'),
                        'level' => 'info',
                    ],
                ],
            ],
        ];

        return new Application($config);
    }

    public function smsAuth(Request $request)
    {
        $templateParam = [
            'code' => '123456',
        ];
        $result = $this->sms($request->phone, 'SMS_161680334', $templateParam);
        return custom_response(null, '108');
    }
}
