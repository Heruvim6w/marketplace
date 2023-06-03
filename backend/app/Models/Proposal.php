<?php

namespace App\Models;

use Carbon\Carbon;
use Decimal\Decimal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $goods_id
 * @property int $external_id
 * @property string $sku
 * @property Decimal $price
 * @property Decimal $old_price
 */
class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    public function properties(): BelongsToMany
    {
        return $this
            ->belongsToMany(Property::class)
            ->withPivot('value');
    }
}
