<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class MaxRatingFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('rating', '<=', $value);
    }
}
