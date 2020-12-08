<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SystemDomain
 *
 * @property int $id
 * @property string $type 类型 merchant:商户, admin:总后台
 * @property string $domain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemDomain whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SystemDomain extends BaseModel
{
    use HasFactory;
}
