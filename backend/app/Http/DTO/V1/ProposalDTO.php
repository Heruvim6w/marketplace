<?php

namespace App\Http\DTO\V1;

final class ProposalDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $sku,
        public readonly string $price,
        public readonly string $oldPrice,
        public readonly string $quantity,
        public readonly bool   $available,
        /** @var PropertyDTO[] $properties */
        public readonly array  $properties,
        /** @var ImageDTO[] $images */
        public readonly array $images,
    ) {
    }
}
