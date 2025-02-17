<?php

namespace App\Filters\DirectorFilters;

use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('name', '=', $value);
    }
}
