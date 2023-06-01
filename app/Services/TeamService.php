<?php

namespace App\Services;

use App\DataTransferObjects\TeamDTO;
use App\Models\ConstructorModel;
use App\Models\ContractModel;
use App\Models\DriverModel;
use App\Models\SeasonModel;
use App\Models\TeamModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class TeamService
{
    private DriverService $driverService;
    private SeasonService $seasonService;
    private ConstructorService $constructorService;

    private DriverTeamMappingService $driverTeamMappingService;

    public function __construct(
        DriverService $driverService,
        SeasonService $seasonService,
        ConstructorService $constructorService,
        DriverTeamMappingService $driverTeamMappingService
    ) {
        $this->driverService = $driverService;
        $this->seasonService = $seasonService;
        $this->constructorService = $constructorService;
        $this->driverTeamMappingService = $driverTeamMappingService;
    }

    public function listTeams(int $seasonId)
    {
        $constructors = ConstructorModel::query()->get();
        foreach ($constructors as $key => $constructor) {
            $drivers = array();
            $constructorDTO = $constructor;
            $contracts = ContractModel::query()
                ->where(ContractModel::SEASON_ID, "=", $seasonId)
                ->where(ContractModel::CONSTRUCTOR_ID, "=", 3)->get();

            $contracts = ContractModel::query()->find(1);
            return $contracts->driver;
            die();
            $team = new TeamDTO($constructorDTO, $drivers);
            return $team->jsonSerialize();
        }

        return $this->driverTeamMappingService->mapTeams($seasonId);
    }

    public function getTeamById(int $id): Model
    {
        $builder = TeamModel::query();
        return $builder->findOrFail($id);
    }

    public function getTeamBySeason(int $constructorId, int $seasonId): Collection|array
    {
        $builder = TeamModel::query();
        return $builder->where(TeamModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))
            ->where(TeamModel::SEASON_ID, "=", $seasonId)
            ->where(TeamModel::CONSTRUCTOR_ID, "=", $constructorId)
            ->get();
    }

    public function getTeamMembersBySeason(int $constructorId, int $seasonId): int
    {
        $builder = TeamModel::query();
        return $builder->where(TeamModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))
            ->where(TeamModel::SEASON_ID, "=", $seasonId)
            ->where(TeamModel::CONSTRUCTOR_ID, "=", $constructorId)
            ->count();
    }

    /**
     * @throws \Exception
     */
    public function getTeamByDriver(int $driverId, int $seasonId): Model|null
    {
        $builder = TeamModel::query();
        return $builder->where(TeamModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))
            ->where(TeamModel::SEASON_ID, "=", $seasonId)
            ->where(TeamModel::DRIVER_ID, "=", $driverId)
            ->first();
    }

    /**
     * @throws \Exception
     */
    public function createTeam(array $data): string
    {
        $teamModel = new TeamModel($data);
        $constructor = $this->constructorService->getConstructorById(
            $teamModel->getConstructorIdAttribute()
        );

        if (!$constructor instanceof ConstructorModel) {
            throw new \InvalidArgumentException("Constructor does not exist");
        }

        if (!$this->driverService->getDriverById($teamModel->getDriverIdAttribute())) {
            throw new \InvalidArgumentException("Driver does not exist");
        }

        if (!$this->seasonService->getSeasonById($teamModel->getSeasonIdAttribute())) {
            throw new \InvalidArgumentException("Season does not exist");
        }

        if ($this->getTeamMembersBySeason(
            $teamModel->getConstructorIdAttribute(), $teamModel->getSeasonIdAttribute()
            ) >= $constructor->getAttribute(ConstructorModel::ALLOWED_DRIVERS)) {
            throw new \InvalidArgumentException("Team is already full");
        }

        if ($this->getTeamByDriver($teamModel->getDriverIdAttribute(), $teamModel->getSeasonIdAttribute())) {
            throw new \InvalidArgumentException("Driver already has a team");
        }

        $teamModel->setAttribute(TeamModel::LEAGUE_ID, \getenv('LEAGUE_ID'));
        $teamModel->save();
        return "TEAM HAS BEEN SAVED";
    }

    public function updateTeam(int $id, array $data)
    {
        /**
         * todo:
         */
    }
}
