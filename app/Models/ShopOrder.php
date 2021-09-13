<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ShopOrder
 *
 * @property int $id
 * @property int $shop_user_id 用户ID
 * @property int $coupon_id 所属活动
 * @property string $order_no 订单号
 * @property int $amount
 * @property int $type 订单类型 1: 购买, 2: 受赠
 * @property string $total_amount 总金额
 * @property string $contact 联系人
 * @property string $phone 电话
 * @property array $region 地区
 * @property string $address 地址
 * @property int $status 当前状态 0: 未发货 , 1: 已发货
 * @property int $payment_status 当前状态 0: 未发货 , 1: 已发货
 * @property string|null $payment_no
 * @property string|null $payment_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShopOrderItem[] $item
 * @property-read int|null $item_count
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder wherePaymentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder wherePaymentNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereShopUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopOrder extends BaseModel
{
    protected $casts = ['region' => 'array'];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->order_no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->order_no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->order_no) {
                    return false;
                }
            }
        });
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
            if (!static::query()->where('order_no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('Find order no failed');
        return false;
    }

    /**
     * @return BelongsTo
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return HasMany
     */
    public function item(): HasMany
    {
        return $this->hasMany(ShopOrderItem::class);
    }
}
