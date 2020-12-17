<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LogisticsCompany
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogisticsCompany whereUpdatedAt($value)
 */
class LogisticsCompany extends Model
{
    use HasFactory;
}
