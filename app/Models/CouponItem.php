<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CouponItem
 *
 * @property int $id
 * @property int $coupon_id
 * @property string $code
 * @property string $password
 * @property int $status 状态 0:未开启, 1:未兑换, 2:已兑换
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CouponItem extends BaseModel
{
    use HasFactory;

    // 未开启
    public const STATUS_DISABLE = 0;
    // 开启
    public const STATUS_ENABLE = 1;
    // 已使用
    public const STATUS_ACTIVATED = 2;
    // 单记录更新
    public const TYPE_SINGLE = 1;
    // 批量更新
    public const TYPE_BATCH = 2;
}
