<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TeamModel extends Model
{
    use SoftDeletes, HasFactory;

    public const CONSTRUCTOR = "constructor";
    public const DRIVER_LIST = "driver_list";


    protected $table = 'teams';

    protected $appends = [
        'constructor',
        'driver'
    ];

    protected $visible = [
        self::CONSTRUCTOR,
        self::DRIVER_LIST
    ];


    public function season(): BelongsTo
    {
        return $this->belongsTo(SeasonModel::class);
    }

    public function driverList(): HasOne
    {
        return $this->hasOne(DriverModel::class, DriverModel::ID);
    }

    public function constructor(): HasOne
    {
        return $this->hasOne(ConstructorModel::class, ConstructorModel::ID);
    }

    public function getConstructorAttribute()
    {
        return $this->constructor()->get();
    }

    public function getDriverAttribute()
    {
        return $this->driver()->get();
    }
}
