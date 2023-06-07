<?php

namespace App\Http\ParamsConverter\V1;

use App\Http\DTO\V1\ImageDTO;

final class SystemImagesConverter
{
    /**
     * @param array $images
     * @return ImageDTO[]
     */
    public function convertToDTO(array $images): array
    {
        return array_map(
            static fn (array $image): ImageDTO => new ImageDTO(
                type: $image['type'],
                url: $image['url'],
            ),
            $images
        );
    }
}
