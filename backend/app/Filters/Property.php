<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Property extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        $words = array_filter(explode(' ', $this->request->get('property')));

        return $builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->whereHas('properties', function ($query)  use ($word) {
                    return $query->where('value', 'ilike', "%$word%");
                });
            }
        });
    }
}
