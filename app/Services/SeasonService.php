<?php

namespace App\Services;

use App\Models\CompetitionModel;
use App\Models\SeasonModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeasonService
{
    public function __construct()
    {
    }

    /**
     * @param int $competitionId
     * @return Collection|array
     */
    public function listSeasons(int $competitionId): Collection|array
    {
        $builder = SeasonModel::query();
        return $builder->where(SeasonModel::LEAGUE_ID, "=", \getenv("LEAGUE_ID"))
            ->where(SeasonModel::COMPETITION_ID, "=", $competitionId)->get();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function getSeasonById(int $id): Model|null
    {
        $builder = SeasonModel::query();
        return $builder->where(SeasonModel::LEAGUE_ID, "=", \getenv("LEAGUE_ID"))
            ->where(SeasonModel::ID, "=", $id)->first();
    }

    /**
     * @throws Exception
     */
    public function createSeason(array $seasonData): bool
    {
        $competition = CompetitionModel::query()->find($seasonData[SeasonModel::COMPETITION_ID]);
        if (!$competition instanceof CompetitionModel) {
            throw new Exception("COMP NOT FOUN");
        }

        $season = new SeasonModel($seasonData);
        if (!$season instanceof SeasonModel) {
            throw new Exception();
        }

        return $season->save();
    }

}
