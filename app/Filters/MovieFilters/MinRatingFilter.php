<?php

namespace App\Filters\MovieFilters;

use Illuminate\Database\Eloquent\Builder;

class MinRatingFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('rating', '>=', $value);
    }
}
