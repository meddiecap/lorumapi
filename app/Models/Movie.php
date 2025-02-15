<?php

namespace App\Models;

use App\Filters\MovieFilters\MovieFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'release_year', 'rating', 'genre_id'];

    protected function casts()
    {
        return [
            'release_year' => 'integer',
            'rating' => 'float',
        ];
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new MovieFilter)->apply($query, $filters);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
