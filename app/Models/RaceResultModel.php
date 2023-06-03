<?php

namespace App\Models;

use App\Utility_Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaceResultModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const RACE_ID = 'race_id';
    public const DRIVER_ID = 'driver_id';
    public const CONSTRUCTOR_ID = 'constructor_id';
    public const POS_QUALI = 'pos_quali';
    public const POS_GRID = 'pos_grid';
    public const POS_RACE = 'pos_race';
    public const PERSONAL_BEST_LAP = 'personal_best_lap';
    public const TIME_PEN = 'time_pen';
    public const FASTEST_LAP = 'fastest_lap';
    public const DNF = 'dnf';
    public const DSQ = 'dsq';
    public const RACETIME = 'race_time';
    public const PITSTOPS = 'pit_stops';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    public const DRIVER = 'driver';
    public const CONSTRUCTOR = 'constructor';
    public const RACE = 'race';

    protected $table = 'race_results';

    protected $fillable = [
        self::LEAGUE_ID,
        self::RACE_ID,
        self::DRIVER_ID,
        self::CONSTRUCTOR_ID,
        self::POS_QUALI,
        self::POS_GRID,
        self::POS_RACE,
        self::PERSONAL_BEST_LAP,
        self::TIME_PEN,
        self::FASTEST_LAP,
        self::DNF,
        self::DSQ,
        self::RACETIME,
        self::PITSTOPS
    ];

    protected $visible = [
        self::ID,
        self::POS_QUALI,
        self::POS_GRID,
        self::POS_RACE,
        self::PERSONAL_BEST_LAP,
        self::TIME_PEN,
        self::FASTEST_LAP,
        self::DNF,
        self::DSQ,
        self::RACETIME,
        self::PITSTOPS,
        self::RACE,
        self::DRIVER,
        self::CONSTRUCTOR
    ];

    protected $appends = [
        self::RACE,
        self::DRIVER,
        self::CONSTRUCTOR
    ];

    /**
     * Use the custom collection that allows tapping
     *
     * @param array $models
     * @return Utility_Collection
     */
    public function newCollection(array $models = []): Utility_Collection
    {
        return new Utility_Collection($models);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(LeagueModel::class, self::LEAGUE_ID);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(RaceModel::class, self::RACE_ID);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(DriverModel::class, self::DRIVER_ID);
    }

    public function constructor(): BelongsTo
    {
        return $this->belongsTo(ConstructorModel::class, self::CONSTRUCTOR_ID);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getLeagueIdAttribute(): int
    {
        return $this->attributes[self::LEAGUE_ID];
    }

    public function getDriverAttribute()
    {
        return $this->driver()->get();
    }

    public function getRaceAttribute()
    {
        return $this->race()->get();
    }

    public function getConstructorAttribute()
    {
        return $this->constructor()->get();
    }

    public function getPosQualiAttribute(): string
    {
        return $this->attributes[self::POS_QUALI];
    }

    public function getPosGridAttribute(): ?string
    {
        return $this->attributes[self::POS_GRID];
    }

    public function getPosRaceAttribute(): ?string
    {
        return $this->attributes[self::POS_RACE];
    }

    public function getPersonalBestLapAttribute(): ?string
    {
        return $this->attributes[self::PERSONAL_BEST_LAP];
    }

    public function getTimePenAttribute(): ?string
    {
        return $this->attributes[self::TIME_PEN];
    }

    public function getDnfAttribute(): ?string
    {
        return $this->attributes[self::DNF];
    }

    public function getDsqAttribute(): ?string
    {
        return $this->attributes[self::DSQ];
    }

    public function getFastestLapAttribute(): ?string
    {
        return $this->attributes[self::FASTEST_LAP];
    }
}
