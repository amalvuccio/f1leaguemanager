<?php

namespace App\Http\Controllers;

use App\Models\LineupModel;
use Illuminate\Database\Eloquent\Collection;

class LineupController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return LineupModel::all();
    }
}
