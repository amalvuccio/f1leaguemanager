<?php

namespace App\Models;

use App\Filters\DriverFilters;
use App\Filters\RaceFilters;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaceModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const SEASON_ID = 'season_id';
    public const TRACK_ID = 'track_id';
    public const CALENDER_POS = 'calender_pos';

    public const POINTS_SYSTEM_ID = 'points_system_id';
    public const PLANNED_AT = 'planned_at';
    public const RACED_AT = 'raced_at';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    public const TRACK = 'track';

    protected $table = 'races';

    protected $fillable = [
        self::LEAGUE_ID,
        self::SEASON_ID,
        self::TRACK_ID,
        self::CALENDER_POS,
        self::PLANNED_AT,
        self::RACED_AT
    ];

    protected $visible = [
        self::ID,
        self::CALENDER_POS,
        self::TRACK
    ];

    protected $appends = [
        self::TRACK
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

    public function season(): BelongsTo
    {
        return $this->belongsTo(SeasonModel::class, self::SEASON_ID);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(TrackModel::class, self::TRACK_ID);
    }

    public function getTrackAttribute()
    {
        return $this->track()->get();
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getLeagueIdAttribute(): int
    {
        return $this->attributes[self::LEAGUE_ID];
    }

    public function getSeasonIdAttribute(): string
    {
        return $this->attributes[self::SEASON_ID];
    }

    public function getTrackIdAttribute(): ?string
    {
        return $this->attributes[self::TRACK_ID];
    }

    public function getCalenderPosAttribute(): ?string
    {
        return $this->attributes[self::CALENDER_POS];
    }

    public function getPlannedAtAttribute(): ?string
    {
        return $this->attributes[self::PLANNED_AT];
    }

    public function getRacedAtAttribute(): ?string
    {
        return $this->attributes[self::RACED_AT];
    }

    public function scopeFilter($query, RaceFilters $filters)
    {
        return $filters->apply($query);
    }
}
