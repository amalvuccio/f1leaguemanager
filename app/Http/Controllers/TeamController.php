<?php

namespace App\Http\Controllers;

use App\Models\TeamModel;
use App\Services\TeamService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Team;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TeamController
{
    private TeamService $teamService;
    /** @return void */
    public function __construct(
        TeamService $teamService
    ) {
        $this->teamService = $teamService;
    }

    public function index(int $seasonId)
    {
        return $this->teamService->listTeams($seasonId);
    }

    public function details(int $seasonId, int $teamId): Model
    {
        return TeamModel::query()->findOrFail($teamId);
    }

    public function update(int $id, Request $request): string
    {
        /**
         * todo: implement service
         */
        $team = TeamModel::query()->find($id);
        if (!$team instanceof TeamModel) {
            throw new NotFoundHttpException();
        }
        $team->update($request->post());

        return "TEAM HAS BEEN UPDATED";
    }

    /**
     * @throws \Exception
     */
    public function create(Request $request): string
    {
        return $this->teamService->createTeam($request->post());
    }

    public function delete(int $id, Request $request): string
    {
        /**
         * todo: implement service
         */
        $team = TeamModel::query()->find($id);
        if (!$team instanceof TeamModel) {
            throw new NotFoundHttpException();
        }
        $team->delete();

        return "TEAM HAS BEEN DELETED";
    }
}
