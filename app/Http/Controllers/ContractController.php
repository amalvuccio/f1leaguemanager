<?php

namespace App\Http\Controllers;

use App\Models\ContractModel;
use App\Services\TeamService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContractController
{
    private TeamService $teamService;

    /** @return void */
    public function __construct(
        TeamService $teamService
    ) {
        $this->teamService = $teamService;
    }

    public function index(int $seasonId): Collection
    {
        return ContractModel::query()->where(ContractModel::SEASON_ID, "=", $seasonId)->get();
    }

    public function details(int $seasonId, int $contractId): Model
    {
        return ContractModel::query()->findOrFail($contractId);
    }

    public function update(int $id, Request $request): string
    {
    }

    /**
     * @throws \Exception
     */
    public function create(Request $request): string
    {
        $contract = new ContractModel($request->post());
        $contract->save();

        return "CONTRACT HAS BEEN SAVED";
    }

    public function delete(int $id, Request $request): string
    {
    }
}
