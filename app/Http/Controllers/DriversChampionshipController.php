<?php

namespace App\Http\Controllers;

use App\Models\ChampionshipDriversModel;
use Illuminate\Database\Eloquent\Collection;

class DriversChampionshipController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return ChampionshipDriversModel::all();
    }
}
