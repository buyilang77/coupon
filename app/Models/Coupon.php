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
 * @property int $product_id
 * @property string $title
 * @property string $start_time
 * @property string $end_time
 * @property string $prefix 前缀
 * @property string $start_number 起始编号
 * @property int $quantity 卡卷数量
 * @property int $length 卡卷长度
 * @property int $status 默认状态 0:待启用, 1:启用, 3:已结束
 * @property string $image 活动主图
 * @property string $tips 活动提示
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_image
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\CouponItem|null $item
 * @property array $products
 * @property-read int|null $item_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereProducts($value)
 */
class Coupon extends BaseModel
{
    use HasFactory;

    protected $casts = ['products' => 'array'];

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
