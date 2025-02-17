<?php

namespace App\Models;

use App\Filters\DirectorFilters\DirectorFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birth_date'];

    protected function casts()
    {
        return [
            'birth_date' => 'datetime:Y-m-d',
        ];
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new DirectorFilter())->apply($query, $filters);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
