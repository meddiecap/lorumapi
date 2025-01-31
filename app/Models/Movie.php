<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\MovieFilter;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'release_year', 'rating', 'genre_id'];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new MovieFilter)->apply($query, $filters);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
