<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverPenaltyModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const RACE_ID = 'race_id';
    public const DRIVER_ID = 'driver_id';
    public const PEN_POINTS = 'pen_grid';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'penalties_drivers';
}
