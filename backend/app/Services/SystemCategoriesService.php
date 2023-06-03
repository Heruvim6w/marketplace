<?php

namespace App\Services;

use App\Http\DTO\V1\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class SystemCategoriesService
{
    public function __construct(
        private readonly SystemPropertiesService $propertiesService
    )
    {
    }

    /**
     * @param Model $baseEntity
     * @param CategoryDTO[] $categories
     */
    public function store(Model $baseEntity, array $categories): void
    {
        foreach ($categories as $category) {
            $entity = Category::query()->firstOrCreate(
                ['name' => $category->name]
            );

            $baseEntity->categories()->attach($entity);
        }
    }
}
