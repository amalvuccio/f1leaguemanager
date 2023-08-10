<?php

namespace App\Http\Controllers;

use App\Filters\DriverFilters;
use App\Models\ChampionshipDriversModel;
use App\Models\DriverModel;
use App\Services\DriverService;
use App\Services\RaceResultService;
use App\Services\StandingsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    private StandingsService $standingsService;

    public function __construct(
        StandingsService $standingsService,
        protected RaceResultService $raceResultService
    ) {
        $this->standingsService = $standingsService;
    }

    public function index()
    {
        $this->standingsService->getTeamStandings();
    }

    public function details($id)
    {
        $raceResults = $this->raceResultService->getRaceResultByRaceId(1);
        $pointsSystem = $this->standingsService->getPointsSystem($id);

        foreach ($raceResults as $result) {

            $ch = new ChampionshipDriversModel([
                ChampionshipDriversModel::LEAGUE_ID => 1,
                ChampionshipDriversModel::SEASON_ID => 1,
                ChampionshipDriversModel::DRIVER_ID => (int)$result->driver->id,
                ChampionshipDriversModel::RACE_ID => (int)$result->race->id,
                ChampionshipDriversModel::POINTS => (int)$pointsSystem[$result->pos_race]
            ]);

            return $ch->save();
        }




    }

    public function getDriverStandings(Request $request)
    {
        $this->standingsService->getDriverStandings($request->post());
    }
}
