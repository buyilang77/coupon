<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RechargeCardItem extends BaseModel
{
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
}
