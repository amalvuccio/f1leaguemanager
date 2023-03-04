<?php

namespace App\Http\Controllers;

use App\Models\LeagueModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeagueController extends Controller
{
    public function __construct(
    ) {
    }

    public function index(): Collection
    {
        return LeagueModel::all();
    }

    public function details(int $id): Builder|array|Collection|Model
    {
        $query = LeagueModel::query();
        return $query->findOrFail($id);
    }

    public function update(int $id, Request $request): string
    {
        $driver = LeagueModel::query()->find($id);
        if (!$driver instanceof LeagueModel) {
            throw new NotFoundHttpException();
        }
        $driver->update($request->post());

        return "LEAGUE HAS BEEN UPDATED";
    }

    /**
     * @throws \Exception
     */
    public function create(Request $request): string
    {
        $driver = new LeagueModel($request->post());
        if (!$driver instanceof LeagueModel) {
            throw new \Exception();
        }
        $driver->save();

        return "LEAGUE HAS BEEN SAVED";
    }

    public function delete(int $id, Request $request): string
    {
        $driver = LeagueModel::query()->find($id);
        if (!$driver instanceof LeagueModel) {
            throw new NotFoundHttpException();
        }
        $driver->delete();

        return "LEAGUE HAS BEEN DELETED";
    }
}
