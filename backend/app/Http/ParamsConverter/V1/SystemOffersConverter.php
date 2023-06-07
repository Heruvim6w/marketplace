<?php

namespace App\Http\ParamsConverter\V1;

use App\Http\DTO\V1\ProposalDTO;

final class SystemOffersConverter
{
    public function __construct(
        private readonly SystemPropertiesConverter $propertiesConverter,
        private readonly SystemImagesConverter $imagesConverter
    )
    {
    }

    /**
     * @param array $offers
     * @return ProposalDTO[]
     */
    public function convertToDTO(array $offers): array
    {
        return array_map(
            fn(array $offer): ProposalDTO => new ProposalDTO(
                id: $offer['id'],
                sku: $offer['sku'],
                price: $offer['price'],
                oldPrice: $offer['oldPrice'],
                quantity: $offer['quantity'],
                available: $offer['available'],
                properties: $this->propertiesConverter->convertToDTO($offer['params']),
                images: $this->imagesConverter->convertToDTO($offer['images'])
            ),
            $offers
        );
    }
}
