<?php

namespace App\Http\Controllers;

use App\Models\RaceModel;
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

    public function index(): Collection
    {
        return RaceModel::all();
    }

    public function create(Request $request): RaceModel
    {
        return $this->raceService->createRace(new RaceModel($request->post()));
    }
}
