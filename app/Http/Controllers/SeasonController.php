<?php

namespace App\Http\Controllers;

use App\Models\CompetitionModel;
use App\Models\SeasonModel;
use App\Services\SeasonService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SeasonController
{
    private SeasonService $seasonService;
    public function __construct(
        SeasonService $seasonService
    ) {
        $this->seasonService = $seasonService;
    }

    public function index(int $competitionId): array|Collection
    {
        return $this->seasonService->listSeasons($competitionId);
    }

    public function details(int $id): array|Model
    {
        $query = SeasonModel::query();
        return $query->where(SeasonModel::LEAGUE_ID, "=", \getenv("LEAGUE_ID"))
            ->findOrFail($id);
    }

    public function update(int $id, Request $request): string
    {
        /**
         * todo: implement service
         */
        $team = SeasonModel::query()->find($id);
        if (!$team instanceof SeasonModel) {
            throw new NotFoundHttpException();
        }
        $team->update($request->post());

        return "SEASON HAS BEEN UPDATED";
    }

    /**
     * @throws \Exception
     */
    public function create(Request $request): bool
    {
        return $this->seasonService->createSeason($request->post());
    }

    public function delete(int $id, Request $request): string
    {
        /**
         * todo: implement service
         */
        return $this->seasonService->deleteSeason($request->post());

        $team = SeasonModel::query()->find($id);
        if (!$team instanceof SeasonModel) {
            throw new NotFoundHttpException();
        }
        $team->delete();

        return "SEASON HAS BEEN DELETED";
    }

}
