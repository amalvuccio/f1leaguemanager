<?php

namespace App\Models;

use App\Filters\DriverFilters;
use App\Utility_Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointsSystemModel extends Model
{
    use SoftDeletes, HasFactory;

    public const ID = 'id';

    public const LEAGUE_ID = 'league_id';

    public const POS = 'pos';

    public const POINTS = 'points';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public const DELETED_AT = 'deleted_at';

    protected $table = 'points_system';

    protected $fillable = [
        self::LEAGUE_ID,
        self::POS,
        self::POINTS
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

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getPosAttribute(): string
    {
        return $this->attributes[self::POS];
    }

    public function getPointsAttribute(): ?string
    {
        return $this->attributes[self::POINTS];
    }
}
