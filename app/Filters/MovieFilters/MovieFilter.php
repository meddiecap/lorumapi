<?php

namespace App\Filters\MovieFilters;

use App\Http\Requests\MovieFilterRequest;
use Illuminate\Database\Eloquent\Builder;

class MovieFilter
{
    protected array $filters = [
        'genre' => GenreFilter::class,
        'release_year' => ReleaseYearFilter::class,
        'min_rating' => MinRatingFilter::class,
        'max_rating' => MaxRatingFilter::class,
        'updated_at' => UpdatedAtFilter::class,
    ];

    /**
     * @param  Builder  $query
     * @param  array  $filters
     *
     * @return Builder
     */
    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            if ($value !== null && isset($this->filters[$key])) {
                (new $this->filters[$key])->apply($query, $value);
            }
        }

        return $query;
    }

    /**
     * Extract and return only allowed filters from the request.
     */
    public function extract(MovieFilterRequest $request): array
    {
        return $request->only(array_keys($this->filters));
    }
}
