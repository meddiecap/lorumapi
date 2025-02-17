<?php

namespace App\Filters\DirectorFilters;

use Illuminate\Database\Eloquent\Builder;

class HasMoviesFilter
{
    public function apply(Builder $query, $value = null): Builder
    {
        if ($value === null) {
            return $query;
        }

        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);

        return $query->when($value, function ($query) {
            $query->has('movies');
        })->when(!$value, function ($query) use ($value) {
            $query->doesntHave('movies');
        });
    }
}
