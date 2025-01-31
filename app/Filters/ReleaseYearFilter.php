<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReleaseYearFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('release_year', $value);
    }
}
