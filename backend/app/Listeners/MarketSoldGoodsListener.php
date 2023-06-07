<?php

namespace App\Listeners;

use App\Events\MarketSoldGoodsEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class MarketSoldGoodsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MarketSoldGoodsEvent $event
     * @return JsonResponse
     */
    public function handle(MarketSoldGoodsEvent $event): JsonResponse
    {
        try {
            Http::post(env('SYSTEM_URL') . '/sold', [
                $event->data
            ]);

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
