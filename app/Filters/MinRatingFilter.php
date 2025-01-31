<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class MinRatingFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('rating', '>=', $value);
    }
}
