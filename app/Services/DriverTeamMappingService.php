<?php

namespace App\Services;

use App\Models\ConstructorModel;
use App\Models\DriverModel;
use App\Models\TeamModel;
use Illuminate\Support\Facades\DB;

class DriverTeamMappingService
{
    private ConstructorModel $constructorModel;
    private TeamModel $teamModel;
    private DriverModel $driverModel;

    private string $driversTable;
    private string $constructorsTable;

    private string $teamsTable;

    public function __construct(
        ConstructorModel $constructorModel,
        TeamModel        $teamModel,
        DriverModel      $driverModel
    ) {
        $this->constructorModel = $constructorModel;
        $this->teamModel = $teamModel;
        $this->driverModel = $driverModel;
        $this->driversTable = \getenv('TABLE_DRIVERS');
        $this->constructorsTable = \getenv('TABLE_CONSTRUCTORS');
        $this->teamsTable = \getenv('TABLE_TEAMS');
    }

    public function mapTeams(int $seasonId)
    {
        $teamList = DB::table(getenv('TABLE_TEAMS'))
            ->select($this->driversTable . '.' . DriverModel::NAME_DISCORD,
                $this->constructorsTable . '.' . ConstructorModel::NAME . ' AS ' . 'constructors_name',
                $this->driversTable . '.' . DriverModel::PLATFORM,
                $this->driversTable . '.' . DriverModel::NAME_INGAME,
                $this->driversTable . '.' . DriverModel::ID . ' AS ' . 'driver_id',
                $this->teamsTable . '.' . TeamModel::ID . ' AS ' . 'team_id',
                $this->constructorsTable . '.' . ConstructorModel::ID . ' AS ' . 'constructor_id'
            )
            ->leftJoin($this->driversTable, $this->teamsTable . '.' . TeamModel::DRIVER_ID, '=', $this->driversTable . '.' . DriverModel::ID)
            ->rightJoin($this->constructorsTable, $this->teamsTable . '.' . TeamModel::CONSTRUCTOR_ID, '=', $this->constructorsTable . '.' . ConstructorModel::ID)
            ->where($this->teamsTable . '.' . TeamModel::LEAGUE_ID, '=', \getenv('LEAGUE_ID'))
            ->where(TeamModel::SEASON_ID, '=', $seasonId)
            ->whereNull($this->teamsTable . '.' . TeamModel::DELETED_AT)
            ->orderBy(TeamModel::CONSTRUCTOR_ID, 'asc')
            ->get();
        return $teamList;
    }
}
