<?php

namespace App\Services;


use App\Models\DriverModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function getDriverTeam(DriverModel $driverModel, int $seasonId)
    {

    }
}
