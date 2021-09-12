<?php

declare(strict_types=1);

use Yansongda\Pay\Pay;

return [
    'wechat' => [
        'default' => [
            // 必填-商户号，服务商模式下为服务商商户号
            'mch_id' => env('MCH_ID'),
            'mp_app_id' => env('MP_APP_ID'),
            // 必填-商户秘钥
            'mch_secret_key' => env('MCH_SECRET_KEY'),
            // 必填-商户私钥
            'mch_secret_cert' => resource_path('wechat_pay/apiclient_key.pem'),
            // 必填-商户公钥证书路径
            'mch_public_cert_path' => resource_path('wechat_pay/apiclient_cert.pem'),
            'notify_url' => 'http://api.shop.hipi5.com/payment/notify',
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ]
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
    // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
    'logger' => [
        'enable' => true,
        'file' => storage_path('logs/wechat_pay.log'),
        'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'daily', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
];
