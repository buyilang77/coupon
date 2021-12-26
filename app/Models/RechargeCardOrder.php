<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RechargeCardOrder extends BaseModel
{
    protected $casts = [
        'region' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->order_num) {
                // 调用 findAvailableNo 生成订单流水号
                $model->order_num = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->order_num) {
                    return false;
                }
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function rechargeCardItem(): BelongsTo
    {
        return $this->belongsTo(RechargeCardItem::class);
    }

    /**
     * @return bool|string
     * @throws \Exception
     */
    public static function findAvailableNo(): bool|string
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('order_num', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }
}
