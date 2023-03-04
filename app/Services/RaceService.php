<?php

namespace App\Services;

use App\Models\RaceModel;

class RaceService
{
    public function __construct()
    {
    }

    public function createRace(RaceModel $raceModel)
    {
        return $raceModel;
    }
}
