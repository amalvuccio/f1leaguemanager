<?php

namespace App\Models;

use App\Utility_Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackModel extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const NAME = 'name';
    public const CITY = 'city';
    public const COUNTRY = 'country';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'tracks';

    protected $visible = [
        self::ID,
        self::NAME,
        self::CITY,
        self::COUNTRY
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
}
