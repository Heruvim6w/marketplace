<?php

namespace App\Http\Controllers\Api\V1\Market;

use App\Events\MarketSoldGoodsEvent;
use App\Http\Controllers\Controller;
use App\Services\MarketGoodsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoodsController extends Controller
{
    /**
     * @param Request $request
     * @param MarketGoodsService $goodsService
     * @return JsonResponse|null
     */
    public function sold(
        Request            $request,
        MarketGoodsService $goodsService
    ): ?JsonResponse
    {
        try {
            $data = $request->all();
            $goodsService->sold($data);
            event(new MarketSoldGoodsEvent($data));

            return new JsonResponse([
                'result' => 'ok'
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'result' => 'error',
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
