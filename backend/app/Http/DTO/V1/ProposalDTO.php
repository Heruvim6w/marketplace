<?php

namespace App\Http\DTO\V1;

final class ProposalDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $sku,
        public readonly string $price,
        public readonly string $oldPrice,
        public readonly bool   $available,
        /** @var \App\Http\DTO\V1\PropertyDTO[] $properties */
        public readonly array  $properties,
    ) {
    }
}
