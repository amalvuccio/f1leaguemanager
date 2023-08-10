<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChampionshipDriversModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const SEASON_ID = 'season_id';
    public const DRIVER_ID = 'driver_id';
    public const RACE_ID = 'race_id';
    public const POINTS = 'points';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'championship_drivers';

    protected $fillable = [
        self::LEAGUE_ID,
        self::SEASON_ID,
        self::DRIVER_ID,
        self::RACE_ID,
        self::POINTS
    ];
}
