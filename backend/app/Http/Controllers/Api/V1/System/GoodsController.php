<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\System;

use App\Events\AddNewGoodsEvent;
use App\Events\RemoveGoodsEvent;
use App\Events\UpdateGoodsEvent;
use App\Http\Controllers\Controller;
use App\Http\ParamsConverter\V1\SystemGoodsConverter;
use App\Services\SystemGoodsService;
use App\Services\SystemProposalsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class GoodsController extends Controller
{
    public function index(SystemGoodsService $goodsService): LengthAwarePaginator
    {
        return $goodsService->index();
    }

    public function store(
        Request              $request,
        SystemGoodsConverter $goodsConverter,
        SystemGoodsService   $goodsService
    ): JsonResponse
    {
        try {
            $goods = $goodsConverter->convertToDTO($request->all());

            $goodsService->store($goods);
            event(new AddNewGoodsEvent($goods));
        } catch (\Exception $exception) {
            return new JsonResponse([
                'result' => 'error',
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $exception->getMessage()
            ]);
        }

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    public function update(
        Request              $request,
        SystemGoodsConverter $goodsConverter,
        SystemGoodsService   $goodsService
    ): JsonResponse
    {
        try {
            $goods = $goodsConverter->convertToDTO($request->all());

            $goodsService->update($goods);
            event(new UpdateGoodsEvent($goods));
        } catch (\Exception $exception) {
            return new JsonResponse([
                'result' => 'error',
                'code' => Response::HTTP_NOT_FOUND,
                'message' => $exception->getMessage()
            ]);
        }

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    public function removeFromSale(
        Request                $request,
        SystemGoodsService     $goodsService,
        SystemProposalsService $proposalsService
    ): JsonResponse
    {
        try {
            $proposalsService->deleteByExternalIds($request->get('offers'));

            $goods = $goodsService->findByExternalId((int) $request->get('id'));

            $goodsService->removeFromSale($goods);
            event(new RemoveGoodsEvent($goods));
        } catch (\Exception $exception) {
            return new JsonResponse([
                'result' => 'error',
                'code' => Response::HTTP_NOT_FOUND,
                'message' => $exception->getMessage()
            ]);
        }

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }
}
