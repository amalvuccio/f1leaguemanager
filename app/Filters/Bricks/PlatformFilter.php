<?php

namespace App\Filters\Bricks;

use Illuminate\Database\Eloquent\Builder;

class PlatformFilter
{
    function __invoke(Builder $query, $slug): Builder
    {
        return $query->where('platform', '=', $slug);
    }
}
