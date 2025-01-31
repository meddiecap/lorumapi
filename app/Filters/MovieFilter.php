<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class MovieFilter
{
    protected array $filters = [
        'genre' => GenreFilter::class,
        'release_year' => ReleaseYearFilter::class,
        'min_rating' => MinRatingFilter::class,
        'max_rating' => MaxRatingFilter::class,
    ];

    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            if ($value !== null && isset($this->filters[$key])) {
                (new $this->filters[$key])->apply($query, $value);
            }
        }

        return $query;
    }
}
