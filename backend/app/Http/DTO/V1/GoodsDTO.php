<?php

namespace App\Http\DTO\V1;

final class GoodsDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $sku,
        public readonly string $name,
        public readonly string $description,
        public readonly string $gender,
        public readonly string $vendor,
        public readonly string $brand,
        public readonly string $date,
        /** @var CategoryDTO[] $categories */
        public readonly array  $categories,
        /** @var ProposalDTO[] $proposals */
        public readonly array  $proposals,
        /** @var PropertyDTO[] $properties */
        public readonly array  $properties,
    ) {
    }
}
