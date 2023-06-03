<?php

namespace App\Http\ParamsConverter\V1;

use App\Http\DTO\V1\CategoryDTO;

final class SystemCategoriesConverter
{
    /**
     * @param array $categories
     * @return CategoryDTO[]
     */
    public function convertToDTO(array $categories): array
    {
        return array_merge(...array_map(
            fn (array $category): array => $this->pluck($category),
            $categories
        ));
    }

    private function pluck(array $categories): array
    {
        return array_map(
            static fn (string $category): CategoryDTO => new CategoryDTO(
                name: $category,
            ),
            $categories
        );
    }
}
