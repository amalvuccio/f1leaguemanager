<?php

namespace App\Http\Controllers;

use App\Models\RaceModel;
use App\Models\TrackModel;
use App\Services\RaceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    private RaceService $raceService;

    public function __construct(
        RaceService $raceService
    ) {
        $this->raceService = $raceService;
    }

    public function details($seasonId, $calenderPos)
    {
        return $this->raceService->getRaceByCalenderPos();
    }

    public function index($seasonId, Request $request): Collection
    {
        $query = RaceModel::query()->where(RaceModel::SEASON_ID, '=', $seasonId);

        if ($request->has('country')) {
            $query->whereHas('track', function ($query) use ($request) {
                $query->where(TrackModel::COUNTRY, 'LIKE', $request->get('country') . '%');
            });
        }

        if ($request->has('city')) {
            $query->whereHas('track', function ($query) use ($request) {
                $query->where(TrackModel::CITY, 'LIKE', $request->get('city') . '%');
            });
        }

        if ($request->has('name')) {
            $query->whereHas('track', function ($query) use ($request) {
                $query->where(TrackModel::NAME, 'LIKE', $request->get('name') . '%');
            });
        }

        return $query->orderBy(RaceModel::CALENDER_POS)->get();
    }

    public function create(Request $request)
    {
        $contract = new RaceModel($request->post());
        $contract->save();

        return "RACE HAS BEEN SAVED";
        //return $this->raceService->createRace(new RaceModel($request->post()));
    }
}
