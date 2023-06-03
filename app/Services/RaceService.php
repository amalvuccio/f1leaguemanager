<?php

namespace App\Services;

use App\Models\RaceModel;
use App\Utility_Collection;
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

    public function getRaceByTrack($name): RaceModel
    {
        $race = RaceModel::query()->whereHas('track',
            function ($query) use ($name) {
                $query->where('country', '=', $name);
            }
        )->first();

        if (!$race) {
            $race = RaceModel::query()->whereHas('track',
                function ($query) use ($name) {
                    $query->where('city', '=', $name);
                }
            )->first();
        }

        if (!$race) {
            $race = RaceModel::query()->whereHas('track',
                function ($query) use ($name) {
                    $query->where('name', '=', $name);
                }
            )->first();
        }

        /** @var RaceModel */
        return $race;
    }

    public function createRace(RaceModel $raceModel)
    {
        return $raceModel;
    }
}
