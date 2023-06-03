<?php

namespace App\Http\ParamsConverter\V1;

use App\Http\DTO\V1\PropertyDTO;

final class SystemPropertiesConverter
{
    /**
     * @param array $params
     * @return PropertyDTO[]
     */
    public function convertToDTO(array $params): array
    {
        return array_map(
            static fn (array $param): PropertyDTO => new PropertyDTO(
                type: $param['type'],
                name: $param['name'],
                title: $param['title'],
                value: $param['value'],
            ),
            $params
        );
    }
}
