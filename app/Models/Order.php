<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $merchant_id 商户ID
 * @property int $coupon_id 所属活动
 * @property string $code 提货码
 * @property array $products 所提商品
 * @property string $consignee 收货人
 * @property string $phone 收货电话
 * @property array $region 地区
 * @property string $address 地址
 * @property string $status 当前状态 0: 未发货 , 1: 已发货
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon $coupon
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereConsignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $logistics_company_id 物流公司ID
 * @property string|null $tracking_number 物流单号
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLogisticsCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTrackingNumber($value)
 * @property int $product_id 所提商品
 * @property-read \App\Models\LogisticsCompany $logisticsCompany
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @property-read \App\Models\Merchant $merchant
 * @property int|null $shop_user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShopUserId($value)
 */
class Order extends BaseModel
{
    protected $casts = [
        'region' => 'array',
        'code'   => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return BelongsTo
     */
    public function logisticsCompany(): BelongsTo
    {
        return $this->belongsTo(LogisticsCompany::class);
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
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
