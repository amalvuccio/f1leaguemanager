<?php

namespace App\Http\Controllers;

use App\Models\DriverModel;
use App\Models\RaceResultModel;
use App\Services\OCRService;
use App\Services\RaceResultService;
use App\Utility_Collection;
use http\QueryString;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RaceResultController
{
    public function __construct(protected RaceResultService $raceResultService, protected OCRService $OCRService)
    {
    }

    public function index($raceId, Request $request): Utility_Collection
    {
        $query = RaceResultModel::query()->where(RaceResultModel::RACE_ID, "=", $raceId);

        if ($request->has('driverDiscordName')) {
            $query->whereHas('driver', function ($query) use ($request) {
                $query->where(DriverModel::NAME_DISCORD, 'LIKE', $request->get('driverDiscordName') . '%');
            });
        }

        /** @var Utility_Collection */
        return $query->get();
    }

    public function details($resultId): Collection
    {
        return RaceResultModel::query()->findOrFail($resultId);
    }

    public function create($raceId, Request $request)
    {
        $result = $this->raceResultService->getRaceResultByRaceId($raceId);

        if ($result->count() > 1 ) {
            throw new BadRequestException("THERE ARE ALREADY RESULTS FOR THIS RACE");
        };

        return $this->OCRService->getRaceData($raceId, $request);
    }
}
