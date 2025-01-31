<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\MovieFilter;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'genre', 'release_year', 'rating'];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new MovieFilter)->apply($query, $filters);
    }
}
