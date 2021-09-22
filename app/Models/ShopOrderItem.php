<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShopOrderItem
 *
 * @property int $id
 * @property int $shop_order_id
 * @property int $coupon_item_id
 * @property int $status 状态 1: 未使用, 2: 已提货, 3: 赠送
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereCouponItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereShopOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopOrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopOrderItem extends BaseModel
{
}
