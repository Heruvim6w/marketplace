<?php

namespace App\Listeners;

use App\Events\SystemSoldGoodsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SystemSoldGoodsListener
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
     * @param SystemSoldGoodsEvent $event
     * @return JsonResponse
     */
    public function handle(SystemSoldGoodsEvent $event): JsonResponse
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
