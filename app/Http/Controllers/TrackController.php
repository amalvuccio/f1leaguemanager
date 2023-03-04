<?php

namespace App\Http\Controllers;

use App\Models\TrackModel;
use Illuminate\Database\Eloquent\Collection;

class TrackController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return TrackModel::all();
    }
}
