<?php

namespace App\Filters\DirectorFilters;

use App\Http\Requests\DirectorFilterRequest;
use Illuminate\Database\Eloquent\Builder;

class DirectorFilter
{
    protected array $filters = [
        'name' => NameFilter::class,
        'has_movies' => HasMoviesFilter::class,
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
    public function extract(DirectorFilterRequest $request): array
    {
        return $request->only(array_keys($this->filters));
    }
}
