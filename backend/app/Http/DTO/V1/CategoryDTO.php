<?php

namespace App\Http\DTO\V1;

final class CategoryDTO
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
