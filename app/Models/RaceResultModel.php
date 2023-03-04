<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaceResultModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const SEASON_ID = 'season_id';
    public const RACE_ID = 'race_id';
    public const DRIVER_ID = 'driver_id';
    public const POS_QUALI = 'pos_quali';
    public const POS_GRID = 'pos_grid';
    public const POS_RACE = 'pos_race';
    public const PEN_TIME = 'pen_time';
    public const FASTEST_LAP = 'fastest_lap';
    public const POINTS_WON = 'points_won';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'race_results';
}
