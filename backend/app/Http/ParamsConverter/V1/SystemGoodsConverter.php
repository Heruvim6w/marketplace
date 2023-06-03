<?php

namespace App\Http\ParamsConverter\V1;

use App\Http\DTO\V1\GoodsDTO;

final class SystemGoodsConverter
{
    public function __construct(
        private readonly SystemPropertiesConverter $propertiesConverter,
        private readonly SystemOffersConverter $offersConverter,
        private readonly SystemCategoriesConverter $categoriesConverter,
    ) {
    }

    public function convertToDTO(array $request): GoodsDTO
    {
        return new GoodsDTO(
            id: $request['id'],
            sku: $request['sku'],
            name: $request['name'],
            description: $request['description'],
            gender: $request['gender'],
            vendor: $request['vendor'],
            brand: $request['brand'],
            date: $request['date'],
            categories: $this->categoriesConverter->convertToDTO($request['categories']),
            proposals: $this->offersConverter->convertToDTO($request['offers']),
            properties: $this->propertiesConverter->convertToDTO($request['params']),
        );
    }
}
