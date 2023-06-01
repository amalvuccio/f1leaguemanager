<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionModel extends Model
{
    use SoftDeletes, HasFactory;
    public const ID = 'id';
    public const LEAGUE_ID = 'league_id';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'competitions';

    public function league(): BelongsTo
    {
        return $this->belongsTo(LeagueModel::class, self::LEAGUE_ID);
    }

    public function season(): HasMany
    {
        return $this->hasMany(SeasonModel::class, SeasonModel::COMPETITION_ID);
    }
}
