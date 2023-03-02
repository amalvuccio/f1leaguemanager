<?php

namespace App\Filters\Bricks;

use Illuminate\Database\Eloquent\Builder;

class NameDiscordFilter
{
    function __invoke(Builder $query, $slug): Builder
    {
        return $query->where('name_discord', 'LIKE', $slug . '%');
    }
}
