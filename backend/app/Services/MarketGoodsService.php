<?php

namespace App\Services;

use App\Models\Proposal;

class MarketGoodsService
{
    public function sold(array $data) {
        $proposal = Proposal::query()
            ->with(['goods', 'properties', 'images'])
            ->where('external_id', $data['external_id'])
            ->firstOrFail();
        $proposal->quantity -= $data['quantity'];
        $proposal->save();
        return $proposal->quantity;
    }
}
