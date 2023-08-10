<?php

namespace App\Services;

use App\Models\ChampionshipDriversModel;

class ChampionshipDriversService
{
    public function __construct()
    {

    }

    public function insertRaceResult(array $data)
    {
        $result = new ChampionshipDriversModel($data);
        return $result->save();
    }
}
