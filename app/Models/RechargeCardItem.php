<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RechargeCardItem extends BaseModel
{
    private static array $openStatus = ['未开启', '已开启'];

    /**
     * @return BelongsTo
     */
    public function rechargeCard(): BelongsTo
    {
        return $this->belongsTo(RechargeCard::class);
    }

    /**
     * @return BelongsTo
     */
    public function shopUser(): BelongsTo
    {
        return $this->belongsTo(ShopUser::class);
    }

    /**
     * Return to open status text.
     * @return string
     */
    public function getOpenStatusTextAttribute(): string
    {
        return self::$openStatus[$this->open_status];
    }
}
