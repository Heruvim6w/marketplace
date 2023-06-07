<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Proposal extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        $words = array_filter(explode(' ', $this->request->get('proposal')));

        return $builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->whereHas('proposals', function ($query) use ($word) {
                    return $query
                        ->where('price', 'ilike', "%$word%")
                        ->orWhere('old_price', 'ilike', "%$word%")
                        ->orWhere('sku', 'ilike', "%$word%");
                });
            }
        });
    }
}
