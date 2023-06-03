<?php

namespace App\Services;

use App\Http\DTO\V1\GoodsDTO;
use App\Models\Goods;
use App\Repositories\GoodsRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemGoodsService
{
    public function __construct(
        private readonly SystemCategoriesService $categoriesService,
        private readonly SystemProposalsService $proposalsService,
        private readonly SystemPropertiesService $propertiesService,
        private readonly GoodsRepository $goodsRepository,
    ) {
    }

    public function index(): LengthAwarePaginator
    {
        return $this->goodsRepository->index();
    }

    public function store(GoodsDTO $goods): Goods
    {
        $entity = new Goods();
        $entity->external_id = $goods->id;
        $entity->name = $goods->name;
        $entity->brand = $goods->brand;
        $entity->sku = $goods->sku;
        $entity->description = $goods->description;
        $entity->status = $goods->proposals ? 1 : 0;
        $entity->save();

        $this->categoriesService->store($entity, $goods->categories);
        $this->proposalsService->store($entity, $goods->proposals);
        $this->propertiesService->store($entity, $goods->properties);

        return $entity;
    }

    public function update(GoodsDTO $goods): Goods
    {
        /** @var Goods $entity */
        $entity = Goods::query()->where('external_id', $goods->id)->firstOrFail();
        $entity->name = $goods->name;
        $entity->brand = $goods->brand;
        $entity->sku = $goods->sku;
        $entity->description = $goods->description;
        $entity->status = $goods->proposals ? 1 : 0;
        $entity->save();

        return $entity;
    }

    public function findByExternalId(int $externalId): Model|Builder
    {
        return Goods::query()
            ->where('external_id', $externalId)
            ->firstOrFail();
    }

    public function removeFromSale(Model|Builder $entity): Builder|Model
    {
        $entity->status = 0;
        $entity->save();

        return $entity;
    }
}
