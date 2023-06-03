<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name
 */
class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function proposals(): BelongsToMany
    {
        return $this
            ->belongsToMany(Proposal::class)
            ->withPivot('value');
    }
}
