<?php

namespace App\Http\Controllers;

use App\Filters\DriverFilters;
use App\Models\DriverModel;
use App\Models\TeamModel;
use App\Services\DriverService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DriverController extends Controller
{
    public function __construct(
        protected DriverService $driverService
    ) {
    }

    public function index(DriverFilters $filters): Collection
    {
        return DriverModel::filter($filters)->get();
    }

    public function details(int $id): Builder|array|Collection|Model
    {
        return DriverModel::query()->findOrFail($id)->with('team');
    }

    public function update(int $id, Request $request): string
    {
        $driver = DriverModel::query()->findOrFail($id);
        $driver->update($request->post());

        return "DRIVER HAS BEEN UPDATED";
    }

    public function create(Request $request): string
    {
        /*
        $data = $request->post();
        foreach ($data as $driver) {
            $driverModel = $this->driverService->getDriverByName($driver);
            $this->driverService->createDriver($driverModel);
        }
        */
        $driver = new DriverModel($request->post());
        $driver->save();

        return "DRIVER HAS BEEN SAVED";
    }

    public function delete(int $id): string
    {
        $driver = DriverModel::query()->findOrFail($id);
        $driver->delete();

        return "DRIVER HAS BEEN DELETED";
    }
}
