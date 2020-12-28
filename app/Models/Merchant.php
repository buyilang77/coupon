<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $name 用户名
 * @property string $surname 姓名
 * @property string $merchant_name 商家名称
 * @property string $phone
 * @property string $password
 * @property int $sex 性别
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string|null $address 详细地址
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Coupon[] $coupon
 * @property-read int|null $coupon_count
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereMerchantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $username 用户名
 * @property array|null $region 地区
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $order
 * @property-read int|null $order_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUsername($value)
 * @property int $status 账号状态 0: 待审核, 1: 审核通过
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereStatus($value)
 */
class Merchant extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = ['region' => 'array'];

    // 账号状态: 审核通过
    public const STATUS_ENABLE = 1;

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = ['password'];

    /**
     * @return HasMany
     */
    public function coupon(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    /**
     * @return HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
