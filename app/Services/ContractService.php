<?php

namespace App\Services;

use App\Models\ConstructorModel;
use Illuminate\Http\Request;
use App\Models\ContractModel;

class ContractService
{
    private DriverService $driverService;

    private TeamService $teamService;

    private ConstructorService $constructorService;

    public function __construct(
        DriverService $driverService,
        TeamService $teamService,
        ConstructorService $constructorService
    ) {
        $this->driverService = $driverService;
        $this->teamService = $teamService;
        $this->constructorService = $constructorService;
    }
    public function create(Request $request)
    {
        $data = $request->post();
        $driver = $this->driverService->getDriverByName($data['driver']);
        $constructor = $this->constructorService->getConstructorByName($data['constructor']);

        $contract = new ContractModel([
            'driver_id' => $driver->id,
            'constructor_id' => $constructor->id,
            'league_id' => $data['league_id'],
            'season_id' => $data['season_id'],
            'principal_id' => 0,
            'length' => $data['length']
        ]);
        $contract->save();

        return "CONTRACT HAS BEEN SAVED";
    }
}
