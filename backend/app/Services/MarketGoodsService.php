<?php

namespace App\Services;

use App\Models\Proposal;

class MarketGoodsService
{
    public function __construct(private readonly MarketOrdersService $ordersService)
    {
    }

    public function sold(array $data) {
        $proposal = Proposal::query()
            ->with(['goods', 'properties', 'images'])
            ->where('external_id', $data['external_id'])
            ->firstOrFail();
        $proposal->quantity -= $data['quantity'];
        $proposal->save();
        $this->ordersService->sold($data);

        return $proposal->quantity;
    }
}
