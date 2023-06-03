<?php

namespace App\Filters;

use App\Filters\Bricks\NameFilter;

class RaceFilters
{
    protected array $filters = [
        'track' => NameFilter::class
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
