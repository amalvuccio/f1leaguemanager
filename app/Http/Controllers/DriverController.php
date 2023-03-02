<?php

namespace App\Http\Controllers;

use App\Filters\DriverFilters;
use App\Models\DriverModel;
use App\Services\DriverService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
        $query = DriverModel::query();
        return $query->findOrFail($id);
    }

    public function update(int $id, Request $request): string
    {
        $driver = DriverModel::query()->find($id);
        if (!$driver instanceof DriverModel) {
            throw new NotFoundHttpException();
        }
        $driver->update($request->post());

        return "DRIVER HAS BEEN UPDATED";

    }

    public function create(Request $request): string
    {
        $driver = new DriverModel($request->post());
        if (!$driver instanceof DriverModel) {
            throw new \Exception();
        }
        $driver->save();

        return "DRIVER HAS BEEN SAVED";
    }

    public function delete(int $id, Request $request): string
    {
        $driver = DriverModel::query()->find($id);
        if (!$driver instanceof DriverModel) {
            throw new NotFoundHttpException();
        }
        $driver->delete();

        return "DRIVER HAS BEEN DELETED";
    }
}
