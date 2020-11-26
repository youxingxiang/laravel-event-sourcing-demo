<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GoodStock
 *
 * @property int $id
 * @property int $good_id
 * @property int $stock_num
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Good $good
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock whereGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock whereStockNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoodStock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoodStock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
