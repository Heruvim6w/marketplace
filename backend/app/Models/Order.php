<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $order_date
 * @property int $buyer_id
 * @property int $delivery_id
 * @property int $payment_id
 * @property int $goods_id
 *
 * @property Buyer $buyer
 * @property Delivery $delivery
 * @property Payment $payment
 * @property Goods $goods
 */
class Order extends Model
{
    use HasFactory;

    public function goods(): BelongsTo
    {
        return $this->belongsTo(Goods::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }
}
