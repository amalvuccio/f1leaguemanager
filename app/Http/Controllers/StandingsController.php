<?php

namespace App\Http\Controllers;

use App\Filters\DriverFilters;
use App\Models\DriverModel;
use App\Services\DriverService;
use App\Services\StandingsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    private StandingsService $standingsService;

    public function __construct(
        StandingsService $standingsService,
    ) {
        $this->standingsService = $standingsService;
    }

    public function index(): false|\GdImage
    {
        $this->standingsService->getTeamStandings();
    }

    public function getDriverStandings(Request $request)
    {
        $this->standingsService->getDriverStandings($request->post());
    }
}
