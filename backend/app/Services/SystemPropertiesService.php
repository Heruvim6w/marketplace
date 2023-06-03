<?php

namespace App\Services;

use App\Http\DTO\V1\PropertyDTO;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;

class SystemPropertiesService
{
    /**
     * @param Model $baseEntity
     * @param PropertyDTO[] $properties
     */
    public function store(Model $baseEntity, array $properties): void
    {
        foreach ($properties as $property) {
            $entity = Property::query()->firstOrCreate(
                ['name' => $property->name]
            );
            $baseEntity->properties()->attach($entity, ['value' => $property->value]);
        }
    }
}
