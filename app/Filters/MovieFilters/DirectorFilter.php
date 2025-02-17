<?php

namespace App\Filters\MovieFilters;

use Illuminate\Database\Eloquent\Builder;

class DirectorFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->whereHas('director', function ($query) use ($value) {
            $query->where('name', $value);
        });
    }
}
