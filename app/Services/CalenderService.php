<?php

namespace App\Services;

use App\Models\CalenderModel;
use App\Models\TrackModel;
use App\Utility_Collection;
use Illuminate\Http\Request;
use App\Models\RaceModel;
use Illuminate\Support\Facades\Log;

class CalenderService
{
    private TrackService $trackService;

    public function __construct(
        TrackService $trackService
    ) {
        $this->trackService = $trackService;
    }

    public function createCalender(array $data)
    {
        $calenderPos = 1;
        $races = new Utility_Collection();

        foreach ($data as $trackName) {
            $track = $this->trackService->findTrack('country', $trackName);
            if (!$track instanceof TrackModel) {
                $track = $this->trackService->findTrack('city', $trackName);
            }

            $race = new RaceModel([
                RaceModel::LEAGUE_ID => 1,
                RaceModel::SEASON_ID => 3,
                RaceModel::TRACK_ID => $track->id,
                RaceModel::CALENDER_POS => $calenderPos,
                RaceModel::PLANNED_AT => null,
                RaceModel::RACED_AT => null
            ]);

            $race->save();
            $races->push($race);
            $calenderPos ++;
        }

        return $races;
    }
}
