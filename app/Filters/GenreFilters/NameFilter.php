<?php

namespace App\Filters\GenreFilters;

use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('name', '=', $value);
    }
}
