<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GoodStockFlow
 *
 * @property int $id
 * @property int $good_id
 * @property int $num
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Good $good
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStockFlow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoodStockFlow extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
