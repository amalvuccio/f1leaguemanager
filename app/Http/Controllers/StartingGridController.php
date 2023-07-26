<?php

namespace App\Http\Controllers;

use App\Services\StartingGridService;

class StartingGridController extends Controller
{
    public function __construct(
        StartingGridService $startingGridService,
    ) {
        $this->startingGridService = $startingGridService;
    }

    public function index()
    {
        return $this->startingGridService->getStartingGrid();
    }
}
