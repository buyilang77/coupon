<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property int $open_status 状态 0:未开启, 1:已开启
 * @property int $redemption_status 状态 0:未兑换, 1:已兑换
 * @property-read \App\Models\Coupon $coupon
 * @property-read mixed $open_status_text
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereOpenStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponItem whereRedemptionStatus($value)
 * @property-read string $redemption_status_text
 */
class CouponItem extends BaseModel
{
    use HasFactory;

    // 未开启
    public const STATUS_DISABLE = 0;
    // 开启
    public const STATUS_ENABLE = 1;
    // 已兑换
    public const STATUS_ACTIVATED = 1;

    private static array $openStatus = ['未开启', '已开启'];
    private static array $redemptionStatus = ['未兑换', '已兑换'];

    /**
     * @return BelongsTo
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Return to open status text.
     * @return string
     */
    public function getOpenStatusTextAttribute(): string
    {
        return self::$openStatus[$this->open_status];
    }

    /**
     * Return to redemption status text.
     * @return string
     */
    public function getRedemptionStatusTextAttribute(): string
    {
        return self::$redemptionStatus[$this->redemption_status];
    }
}
