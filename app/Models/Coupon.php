<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property int $merchant_id
 * @property array $products
 * @property string $title 活动名称
 * @property string|null $services_phone 客服电话
 * @property string|null $activity_description 活动说明
 * @property string $start_time
 * @property string $end_time
 * @property string|null $prefix 前缀
 * @property string $start_number 起始编号
 * @property int $quantity 卡券数量
 * @property int $length 卡券长度
 * @property int $status 默认状态 0:未开始, 1:进行中, 2:已结束
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponItem[] $item
 * @property-read int|null $item_count
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $order
 * @property-read int|null $order_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereActivityDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereServicesPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $price
 * @property string $original_price
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePrice($value)
 */
class Coupon extends BaseModel
{
    use HasFactory;

    protected $casts = ['products' => 'array'];

    // Coupon status
    public const STATUS_ENABLE = 1;

    /**
     * @return HasMany
     */
    public function item(): HasMany
    {
        return $this->hasMany(CouponItem::class);
    }

    /**
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
