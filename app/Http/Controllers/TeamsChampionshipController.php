<?php

namespace App\Http\Controllers;

use App\Models\TeamsChampionshipModel;
use Illuminate\Database\Eloquent\Collection;

class TeamsChampionshipController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return TeamsChampionshipModel::all();
    }
}
