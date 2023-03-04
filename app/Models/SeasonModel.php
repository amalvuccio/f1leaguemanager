<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->hasMany(TeamModel::class);
    }

    public function race(): HasMany
    {
        return $this->hasMany(RaceModel::class);
    }

    public function championshipDrivers(): HasMany
    {
        return $this->hasMany(DriversChampionshipModel::class);
    }

    public function championshipTeams(): HasMany
    {
        return $this->hasMany(TeamsChampionshipModel::class);
    }
}
