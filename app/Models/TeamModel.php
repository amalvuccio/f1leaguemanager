<?php

namespace App\Models;

use App\Utility_Collection;
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
    public const DRIVERS = "drivers";


    protected $table = 'teams';

    protected $appends = [
        'constructor',
        'drivers'
    ];

    protected $visible = [
        self::CONSTRUCTOR,
        self::DRIVERS
    ];

    private ConstructorModel $constructor;
    private Utility_Collection $drivers;

    public function __construct(ConstructorModel $constructor, Utility_Collection $drivers)
    {
        $this->constructor = $constructor;
        $this->drivers = $drivers;
    }

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

    public function season(): BelongsTo
    {
        return $this->belongsTo(SeasonModel::class);
    }

    public function getConstructorAttribute()
    {
        return $this->constructor;
    }

    public function getDriversAttribute()
    {
        return $this->drivers;
    }

    public function setConstructorAttribute(ConstructorModel $constructorModel)
    {
        $this->constructor = $constructorModel;
    }

    public function setDriversAttribute(Utility_Collection $driverModel)
    {
        $this->drivers = $driverModel;
    }
}
