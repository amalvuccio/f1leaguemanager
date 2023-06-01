<?php

namespace App\Http\Controllers;

use App\Models\CompetitionModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompetitionController
{
    public function __construct(
    ) {
    }

    /**
     * @param int $leagueId
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return CompetitionModel::query()->where(CompetitionModel::LEAGUE_ID, "=", \getenv('LEAGUE_ID'))->get();
    }

    /**
     * @param int $id
     * @return Builder|array|Collection|Model
     */
    public function details(int $id): Builder|array|Collection|Model
    {
        return CompetitionModel::query()->findOrFail($id);
    }

    public function create()
    {
        /**
         * todo: implement route
         */
    }
}
