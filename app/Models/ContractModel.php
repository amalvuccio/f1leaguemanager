<?php

namespace App\Models;

use App\Utility_Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ContractModel extends Model
{
    use SoftDeletes, HasFactory;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const SEASON_ID = 'season_id';
    public const DRIVER_ID = 'driver_id';
    public const CONSTRUCTOR_ID = 'constructor_id';
    public const PRINCIPAL_ID = 'principal_id';
    public const LENGTH = 'length';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const CONSTRUCTOR = "constructor";
    public const DRIVER = "driver";

    protected $table = 'contracts';

    protected $visible = [
        self::SEASON_ID,
        self::LENGTH,
        self::CONSTRUCTOR,
        self::DRIVER
    ];

    protected $appends = [
        self::CONSTRUCTOR,
        self::DRIVER
    ];
    protected $fillable = [
        self::LEAGUE_ID,
        self::SEASON_ID,
        self::DRIVER_ID,
        self::CONSTRUCTOR_ID,
        self::PRINCIPAL_ID,
        self::LENGTH
    ];

    /**
     * Use the custom collection that allows tapping
     *
     * @return Utility_Collection
     */
    public function newCollection(array $models = array()): Utility_Collection
    {
        return new Utility_Collection($models);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(LeagueModel::class, self::LEAGUE_ID);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(SeasonModel::class, self::SEASON_ID);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(DriverModel::class, self::DRIVER_ID);
    }

    public function constructor(): BelongsTo
    {
        return $this->belongsTo(ConstructorModel::class, self::CONSTRUCTOR_ID);
    }

    public function getConstructorAttribute()
    {
        return $this->constructor()->get();
    }

    public function getDriverAttribute()
    {
        return $this->driver()->get();
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

    public function getDriverIdAttribute(): int
    {
        return $this->attributes[self::DRIVER_ID];
    }

    public function getConstructorIdAttribute(): int
    {
        return $this->attributes[self::CONSTRUCTOR_ID];
    }

    public function getPrincipalIdAttribute(): int
    {
        return $this->attributes[self::PRINCIPAL_ID];
    }

    public function getLengthAttribute(): int
    {
        return $this->attributes[self::LENGTH];
    }
}
