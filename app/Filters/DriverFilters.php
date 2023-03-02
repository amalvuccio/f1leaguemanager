<?php

namespace App\Filters;

use App\Filters\Bricks\NameDiscordFilter;
use App\Filters\Bricks\NameFilter;
use App\Filters\Bricks\NameIngameFilter;
use App\Filters\Bricks\NamePsnFilter;
use App\Filters\Bricks\PlatformFilter;

class DriverFilters
{
    protected array $filters = [
        'discordName' => NameDiscordFilter::class,
        'psnName' => NamePsnFilter::class,
        'ingameName' => NameIngameFilter::class,
        'platform' => PlatformFilter::class,
        'name' => NameFilter::class
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }

    public function receivedFilters(): array
    {
        return request()->only(array_keys($this->filters));
    }
}
