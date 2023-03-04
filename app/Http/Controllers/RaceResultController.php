<?php

namespace App\Http\Controllers;

use App\Models\RaceResultModel;
use Illuminate\Database\Eloquent\Collection;

class RaceResultController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return RaceResultModel::all();
    }
}
