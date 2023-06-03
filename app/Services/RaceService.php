<?php

namespace App\Services;

use App\Models\RaceModel;
use function PHPUnit\TestFixture\func;

class RaceService
{
    public function __construct()
    {
    }

    public function getSeasonCalender($seasonId)
    {
        return RaceModel::query()->where(RaceModel::SEASON_ID, "=", $seasonId)->orderBy(RaceModel::CALENDER_POS)->get();
    }

    public function getRaceByTrack($name)
    {
        return RaceModel::query()->whereHas('track',
            function ($query) use ($name) {
                $query->where('country', '=', $name);
            }
        )->get();
    }

    public function createRace(RaceModel $raceModel)
    {
        return $raceModel;
    }
}
