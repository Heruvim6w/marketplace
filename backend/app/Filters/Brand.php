<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Brand extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        $words = array_filter(explode(' ', $this->request->get('brand')));

        return $builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('brand', 'ilike', "%$word%");
            }
        });
    }
}
