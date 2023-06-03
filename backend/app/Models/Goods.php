<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $brand
 * @property string $sku
 * @property int $status
 * @property int $category_id
 * @property int $external_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Goods extends Model
{
    use HasFactory;

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function properties(): BelongsToMany
    {
        return $this
            ->belongsToMany(Property::class)
            ->withPivot('value');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
