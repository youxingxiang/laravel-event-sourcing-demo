<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Good
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Good newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Good newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Good query()
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereUuid($value)
 * @mixin \Eloquent
 */
class Good extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stock(): HasOne
    {
        return $this->hasOne(GoodStock::class);
    }
}
