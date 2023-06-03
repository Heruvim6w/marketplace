<?php

namespace App\Services;

use App\Http\DTO\V1\ProposalDTO;
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
            // ToDo
            $entity->external_id = -1;
            $entity->sku = $proposal->sku;
            $entity->price = $proposal->price;
            $entity->old_price = $proposal->oldPrice;
            $entity->save();

            $this->propertiesService->store($entity, $proposal->properties);
        }
    }

    public function deleteByExternalIds(array $externalIds)
    {
        return  Proposal::query()
            ->whereIn('external_id', $externalIds)
            ->delete();
    }

    public function delete(Model $baseEntity): void
    {
        $baseEntity->delete();
    }
}
