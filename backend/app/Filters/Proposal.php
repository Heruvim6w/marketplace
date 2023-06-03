<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Proposal extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        $words = array_filter(explode(' ', $this->request->get('proposal')));
//ToDo
        return $builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->whereHas('properties', function ($query) use ($word) {
                    $query->whereHas('proposals', function ($query) use ($word) {
                        return $query->where('value', 'ilike', "%$word%");
                    });
                });
            }
        });
    }
}
