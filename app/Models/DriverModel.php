<?php

namespace App\Models;

use App\Filters\DriverFilters;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverModel extends Model
{
    use SoftDeletes, HasFactory;

    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const NAME_DISCORD = 'name_discord';
    public const NAME_PSN = 'name_psn';
    public const NAME_INGAME = 'name_ingame';
    public const PLATFORM = 'platform';
    public const NAME = 'name';
    public const AGE = 'age';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const DELETED_AT = 'deleted_at';

    protected $table = 'drivers';

    protected $fillable = [
        self::LEAGUE_ID,
        self::NAME_DISCORD,
        self::NAME_PSN,
        self::NAME_INGAME,
        self::PLATFORM,
        self::NAME,
        self::AGE
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
        return $this->belongsTo(LeagueModel::class);
    }

    public function team(): HasOne
    {
        return $this->hasOne(TeamModel::class, TeamModel::DRIVER_ID);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getDiscordNameAttribute(): string
    {
        return $this->attributes[self::NAME_DISCORD];
    }

    public function getPsnNameAttribute(): ?string
    {
        return $this->attributes[self::NAME_PSN];
    }

    public function getIngameNameAttribute(): ?string
    {
        return $this->attributes[self::NAME_INGAME];
    }

    public function getPlatformAttribute(): string
    {
        return $this->attributes[self::PLATFORM];
    }

    public function getDriverNameAttribute(): ?string
    {
        return $this->attributes[self::NAME];
    }

    public function getDriverAgeAttribute(): ?int
    {
        return $this->attributes[self::AGE];
    }

    public function scopeFilter($query, DriverFilters $filters)
    {
        return $filters->apply($query);
    }
}
