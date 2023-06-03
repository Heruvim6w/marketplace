<?php

namespace App\Http\DTO\V1;

final class PropertyDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly string $title,
        public readonly string $value,
    ) {
    }
}
