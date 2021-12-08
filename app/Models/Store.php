<?php

namespace App\Models;

class Store extends BaseModel
{
    protected $casts = [
        'region' => 'array',
        'business_hours' => 'array',
    ];
}
