<?php

namespace App\Filters\MovieFilters;

use Illuminate\Database\Eloquent\Builder;

class GenreFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->whereHas('genre', function ($query) use ($value) {
            $query->where('name', $value);
        });
    }
}
