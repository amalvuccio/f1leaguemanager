<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeagueModel extends Model
{
    use SoftDeletes, HasFactory;
    public const ID = 'id';
    public const NAME = 'name';
    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'leagues';

    public function competition(): HasMany
    {
        return $this->hasMany(CompetitionModel::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getLeagueNameAttribute(): ?string
    {
        return $this->attributes[self::NAME];
    }
}
