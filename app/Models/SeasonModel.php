<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeasonModel extends Model
{
    use SoftDeletes, HasFactory;

    public const ID = 'id';

    public const LEAGUE_ID = 'league_id';
    public const COMPETITION_ID = 'competition_id';
    public const NAME = 'name';
    public const PLANNED_RACES = 'planned_races';
    public const START_DATE = 'start_date';
    public const END_DATE = 'end_date';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const DELETED_AT = 'deleted_at';

    protected $table = 'seasons';

    protected $fillable = [
        self::COMPETITION_ID,
        self::NAME,
        self::PLANNED_RACES,
        self::START_DATE,
        self::END_DATE
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(TeamModel::class, TeamModel::SEASON_ID);
    }

    public function race(): HasMany
    {
        return $this->hasMany(RaceModel::class, RaceModel::SEASON_ID);
    }

    public function championshipDrivers(): HasMany
    {
        return $this->hasMany(ChampionshipDriversModel::class, ChampionshipDriversModel::SEASON_ID);
    }

    public function championshipTeams(): HasMany
    {
        return $this->hasMany(TeamsChampionshipModel::class, TeamsChampionshipModel::SEASON_ID);
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(CompetitionModel::class, self::COMPETITION_ID);
    }
}
