<?php

namespace App\Services;

use App\Models\RaceModel;
use App\Models\RaceResultModel;
use App\Utility_Collection;
use Illuminate\Http\Request;

class RaceResultService
{
    public function createRaceResult($raceId, Request $request)
    {
        $raceResult = new RaceResultModel($request->post());
        $raceResult->save();
    }

    public function getRaceResultByRaceId($raceId): Utility_Collection
    {
        RaceModel::query()->findOrFail($raceId);
        /** @var Utility_Collection */
        return RaceResultModel::query()->where(RaceResultModel::RACE_ID, "=", $raceId)->get();
    }

    public function getRaceResultForDriver(int $raceId, int $driverId): RaceResultModel|null
    {
        /** @var RaceResultModel */
        return RaceResultModel::query()->where(RaceResultModel::RACE_ID, "=", $raceId)
            ->where(RaceResultModel::DRIVER_ID, '=', $driverId)->first();
    }
}
