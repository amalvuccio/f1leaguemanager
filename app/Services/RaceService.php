<?php

namespace App\Services;

use App\Models\RaceModel;

class RaceService
{
    public function __construct()
    {
    }

    public function getSeasonCalender($seasonId)
    {
        return RaceModel::query()->where(RaceModel::SEASON_ID, "=", $seasonId)->orderBy(RaceModel::CALENDER_POS)->get();
    }

    public function getRaceByCalenderPos($seasonId, $calenderPos)
    {
        return RaceModel::query()->where(RaceModel::SEASON_ID, '=', $seasonId)->where(RaceModel::CALENDER_POS, '=', $calenderPos)->first();
    }

    public function getRaceByTrack($name): RaceModel
    {
        $race = RaceModel::query()->whereHas('track',
            function ($query) use ($name) {
                $query->where('country', 'LIKE', $name . '%');
            }
        )->first();

        if (!$race) {
            $race = RaceModel::query()->whereHas('track',
                function ($query) use ($name) {
                    $query->where('city', 'LIKE', $name . '%');
                }
            )->first();
        }

        if (!$race) {
            $race = RaceModel::query()->whereHas('track',
                function ($query) use ($name) {
                    $query->where('name', 'LIKE', $name . '%');
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
