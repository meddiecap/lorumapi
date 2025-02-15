<?php

namespace App\Models;

use App\Filters\GenreFilters\GenreFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new GenreFilter())->apply($query, $filters);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
