<?php

namespace App\Http\Controllers;

use App\Models\RaceResultModel;
use App\Services\OCRService;
use App\Services\RaceResultService;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RaceResultController
{
    public function __construct(protected RaceResultService $raceResultService, protected OCRService $OCRService)
    {
    }

    public function index($raceId): Utility_Collection
    {
        /** @var Utility_Collection */
        return $this->raceResultService->getRaceResultByRaceId($raceId);

        //return RaceResultModel::query()->where(RaceResultModel::RACE_ID, "=", $raceId)->get();
    }

    public function details($resultId): Collection
    {
        return RaceResultModel::query()->findOrFail($resultId);
    }

    public function create($raceId, Request $request)
    {
        return $this->OCRService->getRaceData($request);
        //$this->raceResultService->createRaceResult($raceId, $request);

        //return "RACE RESUlT HAS BEEN SAVED";
    }
}
