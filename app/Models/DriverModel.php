<?php

namespace App\Models;

use App\Filters\DriverFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverModel extends Model
{
    use SoftDeletes, HasFactory;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const COMPETITION_ID = 'competition_id';

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
        self::COMPETITION_ID,
        self::NAME_DISCORD,
        self::NAME_PSN,
        self::NAME_INGAME,
        self::PLATFORM,
        self::NAME,
        self::AGE
    ];

    protected array $maps = [
        self::ID => 'id',
        self::COMPETITION_ID => 'competition_id',
        self::NAME_DISCORD => 'discordName',
        self::NAME_PSN => 'psnName',
        self::NAME_INGAME => 'ingameName',
        self::PLATFORM => 'platform',
        self::NAME => 'driverName',
        self::AGE => 'driverAge',
        self::CREATED_AT => 'createdAt',
        self::UPDATED_AT => 'updatedAt',
        self::DELETED_AT => 'deletedAt'
    ];

    protected $appends = [
        'id',
        'discordName',
        'psnName',
        'ingameName',
        'platform',
        'driverName',
        'driverAge'
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(LeagueModel::class);
    }

    public function competition(): BelongsToMany
    {
        return $this->belongsToMany(CompetitionModel::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(TeamModel::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getCompetitionAttribute(): int
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
