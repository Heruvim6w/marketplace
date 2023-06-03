<?php

namespace App\Models\Traits;

use DateTimeInterface;

trait DateSerializerTrait
{
    protected function serializeDate(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(DateTimeInterface::ATOM);
    }
}
