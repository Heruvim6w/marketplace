<?php

namespace App\Listeners;

use App\Events\RemoveGoodsEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class RemoveGoodsListener
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
     * @param RemoveGoodsEvent $event
     * @return JsonResponse
     */
    public function handle(RemoveGoodsEvent $event): JsonResponse
    {
        try {
            Http::post(env('STORE_URL') . '/delete', [
                $event->goods->toJson()
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
