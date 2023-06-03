<?php

namespace App\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderResource
 * @package App\Http\Resource
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_date' => $this->order_date,
            'buyer' => $this->buyer,
            'delivery' => $this->delivery,
            'payment' => $this->payment
        ];
    }
}
