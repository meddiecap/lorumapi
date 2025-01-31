<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class GenreFilter
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('genre', $value);
    }
}
