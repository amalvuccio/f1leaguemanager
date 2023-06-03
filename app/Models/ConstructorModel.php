<?php

namespace App\Models;

use App\Utility_Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConstructorModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const NAME = 'name';
    public const NAME_OCR = 'name_ocr';
    public const ALLOWED_DRIVERS = 'allowed_drivers';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $visible = [
        self::ID,
        self::NAME
    ];

    protected $table = 'constructors';


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

    public function getIdAttribute(): int
    {
        return $this->attributes[self::ID];
    }

    public function getAllowedDriversAttribute(): int
    {
        return $this->attributes[self::ALLOWED_DRIVERS];
    }

}
