<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConstructorModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const NAME = 'name';
    public const ALLOWED_DRIVERS = 'allowed_drivers';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'constructors';

    public function getAllowedDriversAttribute(): int
    {
        return $this->attributes[self::ALLOWED_DRIVERS];
    }

}
