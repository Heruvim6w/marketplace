<?php

namespace App\Http\Controllers\Api\V1\System;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Order;
use App\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function getOrder(int $externalId): JsonResponse
    {
        /** @var Goods $goods */
        $goods = Goods::query()->where('external_id', $externalId)->firstOrFail();
        $order = Order::query()->findOrFail($goods->id);

        return new JsonResponse(
            new OrderResource($order)
        );
    }
}
