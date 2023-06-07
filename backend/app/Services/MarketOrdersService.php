<?php

namespace App\Services;

use App\Models\Buyer;
use App\Models\Delivery;
use App\Models\Goods;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Proposal;

class MarketOrdersService
{
    public function sold(array $data) {
        $buyer = Buyer::query()
            ->where('phone', $data['buyer']['phone'])
            ->firstOrCreate([
                'last_name' => $data['buyer']['last_name'],
                'name' => $data['buyer']['name'],
                'second_name' => $data['buyer']['second_name'] ?? null,
                'phone' => $data['buyer']['phone'],
                'email' => $data['buyer']['email'] ?? null,
            ]);

        $delivery = Delivery::query()->create([
            'name' => $data['order']['name'],
            'address' => $data['order']['address'],
        ]);

        $payment = Payment::query()->create([
            'name' => $data['payment']['name'],
            'requisites' => $data['payment']['requisites'],
        ]);

        $goods = Goods::query()->where('external_id', $data['goods']['external_id'])->firstOrFail();

        Order::query()->create([
            'buyer_id' => $buyer->id,
            'delivery_id' => $delivery->id,
            'payment_id' => $payment->id,
            'goods_id' => $goods->id,
        ]);
    }
}
