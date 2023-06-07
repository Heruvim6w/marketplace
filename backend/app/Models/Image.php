<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $proposal_id
 * @property string $type
 * @property string $url
 */
class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'type',
        'url',
    ];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }
}
