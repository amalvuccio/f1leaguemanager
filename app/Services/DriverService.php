<?php

namespace App\Services;

use App\Models\DriverModel;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DriverService
{
    public function __construct()
    {

    }

    public function getDriverById(int $id): Model|null
    {
        $builder = DriverModel::query();
        return $builder->where(DriverModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))
            ->where(DriverModel::ID, "=", $id)
            ->first();
    }

    public function getDriverByName(string $name) {
        $builder = DriverModel::query();
        return $builder->where(DriverModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))
            ->where(DriverModel::NAME_DISCORD, 'LIKE', $name . '%')
            ->first();
    }

    public function getDriverTeam(DriverModel $driverModel, int $seasonId)
    {

    }

    public function createDriver(DriverModel $driverModel)
    {
        $driver = new DriverModel([
            'league_id' => 1,
            'competition_id' => 2,
            'name_discord' => $driverModel->discordName,
            'name_psn' => $driverModel->psnName,
            'name_ingame' => $driverModel->ingameName,
            'platform' => $driverModel->platform,
            'name' => $driverModel->driverName,
            'age' => $driverModel->driverAge
        ]);
        $driver->save();

        return "DRIVER HAS BEEN SAVED";
    }
}
