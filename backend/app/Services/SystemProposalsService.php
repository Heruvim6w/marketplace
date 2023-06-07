<?php

namespace App\Services;

use App\Http\DTO\V1\ProposalDTO;
use App\Models\Image;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;

class SystemProposalsService
{
    public function __construct(
        private readonly SystemPropertiesService $propertiesService
    )
    {
    }

    /**
     * @param Model $baseEntity
     * @param ProposalDTO[] $proposals
     */
    public function store(Model $baseEntity, array $proposals): void
    {
        foreach ($proposals as $proposal) {
            $entity = new Proposal();
            $entity->goods_id = $baseEntity->id;
            $entity->external_id = $proposal->id;
            $entity->sku = $proposal->sku;
            $entity->price = $proposal->price;
            $entity->old_price = $proposal->oldPrice;
            $entity->quantity = $proposal->quantity;
            $entity->save();

            foreach ($proposal->images as $imageItem) {
                $image = new Image();
                $image->type = $imageItem->type;
                $image->url = $imageItem->url;
                $entity->images()->save($image);
            }

            $this->propertiesService->store($entity, $proposal->properties);
        }
    }

    public function deleteByExternalIds(array $externalIds)
    {
        $proposals = Proposal::query()
            ->whereIn('external_id', $externalIds)
            ->get();

        foreach ($proposals as $proposal) {
            $proposal->available = false;
            $proposal->save();
        }
    }
}
