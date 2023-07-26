<?php

namespace App\Services;

use App\Models\ConstructorModel;
use Illuminate\Database\Eloquent\Model;

class ConstructorService
{
    public function __construct()
    {
    }

    public function getConstructorById(int $id): Model|null
    {
        return ConstructorModel::query()->where(ConstructorModel::ID, "=", $id)->first();
    }

    public function getConstructorByName(string $name): Model|null
    {
        return ConstructorModel::query()->where(ConstructorModel::NAME, 'LIKE', $name . '%')->first();
    }
}
