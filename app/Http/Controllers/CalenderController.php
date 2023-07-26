<?php

namespace App\Http\Controllers;

use App\Services\CalenderService;
use Illuminate\Http\Request;

class CalenderController
{
    private CalenderService $calenderService;

    public function __construct(
        CalenderService $calenderService
    ) {
        $this->calenderService = $calenderService;
    }
    public function index()
    {

    }

    public function details()
    {

    }

    public function create(Request $request)
    {
        return $this->calenderService->createCalender($request->post());
    }
}
