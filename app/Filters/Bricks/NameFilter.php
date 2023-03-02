<?php

namespace App\Filters\Bricks;

use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    function __invoke(Builder $query, $slug): Builder
    {
        return $query->where('name', 'LIKE', $slug . '%');
    }
}
