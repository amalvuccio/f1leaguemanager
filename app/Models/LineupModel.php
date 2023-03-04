<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineupModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const RACE_ID = 'race_id';
    public const TEAM_ID = 'team_id';
    public const CONSTRUCTOR_ID = 'constructor_id';
    public const DRIVER_ID = 'pos_quali';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'race_lineup';
}
