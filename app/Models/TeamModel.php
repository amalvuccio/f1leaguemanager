<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TeamModel extends Model
{
    use SoftDeletes, HasFactory;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const SEASON_ID = 'season_id';
    public const CONSTRUCTOR_ID = 'constructor_id';
    public const DRIVER_ID = 'driver_id';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'teams';

    protected $visible = [
        'id',
        'discordName',
        'psnName',
        'ingameName',
        'platform',
        'driverName',
        'driverAge'
    ];

    protected $fillable = [
        self::SEASON_ID,
        self::CONSTRUCTOR_ID,
        self::DRIVER_ID
    ];

    protected array $maps = [
        self::ID => 'id',
        self::LEAGUE_ID => 'league_id',
        self::SEASON_ID => 'season_id',
        self::CONSTRUCTOR_ID => 'constructor_id',
        self::DRIVER_ID => 'driver_id',
        self::CREATED_AT => 'createdAt',
        self::UPDATED_AT => 'updatedAt',
        self::DELETED_AT => 'deletedAt'
    ];

    protected $appends = [
        'id',
        'season_id',
        'constructor_id',
        'driver_id'
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(SeasonModel::class);
    }

    public function driver(): HasMany
    {
        return $this->hasMany(DriverModel::class);
    }

    public function constructor(): HasMany
    {
        return $this->hasMany(ConstructorModel::class);
    }

    public function getFacade(): Builder
    {
        return DB::table($this->table);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getLeagueIdAttribute(): int
    {
        return $this->attributes[self::LEAGUE_ID];
    }

    public function getSeasonIdAttribute(): int
    {
        return $this->attributes[self::SEASON_ID];
    }

    public function getConstructorIdAttribute(): int
    {
        return $this->attributes[self::CONSTRUCTOR_ID];
    }

    public function getDriverIdAttribute(): int
    {
        return $this->attributes[self::DRIVER_ID];
    }
}
