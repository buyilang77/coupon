<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\ShopUser
 *
 * @property int $id
 * @property string|null $mp_openid
 * @property string|null $unionid
 * @property string $username 用户名
 * @property string|null $phone 手机号
 * @property string|null $avatar
 * @property string|null $password
 * @property mixed|null $region 地区
 * @property string|null $address 详细地址
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShopOrder[] $order
 * @property-read int|null $order_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $receivedOrder
 * @property-read int|null $received_order_count
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereMpOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopUser whereUsername($value)
 * @mixin \Eloquent
 */
class ShopUser extends Authenticatable implements JWTSubject
{

    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(ShopOrder::class);
    }

    /**
     * @return HasMany
     */
    public function receivedOrder(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
