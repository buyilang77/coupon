<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RechargeCard extends BaseModel
{
    protected $casts = ['carousel' => 'array'];

    /**
     * @return HasMany
     */
    public function item(): HasMany
    {
        return $this->hasMany(RechargeCardItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
