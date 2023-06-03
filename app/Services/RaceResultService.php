<?php

namespace App\Services;

use App\Models\RaceResultModel;
use Illuminate\Http\Request;

class RaceResultService
{
    public function createRaceResult($raceId, Request $request)
    {
        $raceResult = new RaceResultModel($request->post());
        $raceResult->save();
    }

    public function getRaceResultByRaceId($raceId)
    {
        return RaceResultModel::query()->where(RaceResultModel::RACE_ID, "=", $raceId)->get();

    }
}
