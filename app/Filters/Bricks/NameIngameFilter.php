<?php

namespace App\Filters\Bricks;

use Illuminate\Database\Eloquent\Builder;

class NameIngameFilter
{
    function __invoke(Builder $query, $slug): Builder
    {
        return $query->where('name_ingame', 'LIKE', $slug . '%');
    }
}
