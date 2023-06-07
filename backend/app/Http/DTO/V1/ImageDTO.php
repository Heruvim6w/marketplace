<?php

namespace App\Http\DTO\V1;

final class ImageDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $url,
    ) {
    }
}
