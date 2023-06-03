<?php

namespace App\Services;

use App\DataTransferObjects\TeamDTO;
use App\Models\ConstructorModel;
use App\Models\ContractModel;
use App\Models\DriverModel;
use App\Models\SeasonModel;
use App\Models\TeamModel;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Phalcon\Flash\Session;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class TeamService
{
    private DriverService $driverService;
    private SeasonService $seasonService;
    private ConstructorService $constructorService;

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

    public function listTeams(int $seasonId): Utility_Collection
    {
        $teamCollection = new Utility_Collection();
        $constructors = ConstructorModel::query()->get();
        foreach ($constructors as $key => $constructor) {
            $contracts = ContractModel::query()
                ->where(ContractModel::SEASON_ID, "=", $seasonId)
                ->where(ContractModel::CONSTRUCTOR_ID, "=", $constructor->id)->get();

            $teamCollection->push(new TeamModel($constructor, $contracts->driver));
        }

        return $teamCollection;
    }

    public function getTeamById(int $constructorId, $seasonId): TeamModel
    {
        /** @var ConstructorModel $constructor */
        $constructor = ConstructorModel::query()->findOrFail($constructorId);

        /** @var Utility_Collection $contracts */
        $contracts = ContractModel::query()
            ->where(ContractModel::SEASON_ID, "=", $seasonId)
            ->where(ContractModel::CONSTRUCTOR_ID, "=", $constructor->id)->get();

        return new TeamModel($constructor, $contracts->driver);
    }

    /**
     * @throws \Exception
     */
    public function getTeamByDriver(int $driverId, int $seasonId): Model|null
    {
        /**
         * todo
         */

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
