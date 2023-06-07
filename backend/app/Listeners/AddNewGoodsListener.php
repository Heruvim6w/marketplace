<?php

namespace App\Listeners;

use App\Events\AddNewGoodsEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AddNewGoodsListener
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
     * @param AddNewGoodsEvent $event
     * @return JsonResponse
     */
    public function handle(AddNewGoodsEvent $event): JsonResponse
    {
        try {
            Http::post(env('STORE_URL') . '/create', [
                json_encode($event->goods, JSON_THROW_ON_ERROR)
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
