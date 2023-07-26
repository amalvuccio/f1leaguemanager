<?php

namespace App\Services;

use App\Models\TrackModel;
use App\Utility_Collection;

class TrackService
{
    public function __construct()
    {

    }

    public function findTrack(string $column, string $value)
    {
        /** @var Utility_Collection $track */
        $track = TrackModel::query()->where($column, 'LIKE', '%'. $value . '%')->first();

        return $track;
    }
}
