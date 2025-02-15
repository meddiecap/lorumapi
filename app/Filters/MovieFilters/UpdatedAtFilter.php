<?php

namespace App\Filters\MovieFilters;

use Illuminate\Database\Eloquent\Builder;

class UpdatedAtFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('updated_at', '>=', $value);
    }
}
