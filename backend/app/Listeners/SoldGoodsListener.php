<?php

namespace App\Listeners;

use App\Events\SoldGoodsEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SoldGoodsListener
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
     * @param SoldGoodsEvent $event
     * @return JsonResponse
     */
    public function handle(SoldGoodsEvent $event): JsonResponse
    {
        try {
            Http::post(env('STORE_URL') . '/sold', [
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
